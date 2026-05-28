<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class VitrinController extends Controller
{
    public function index()
    {
        // Données à passer à Vue.js
        $data = [
            'nb_collections' => $this->getNbCollections(),
            'nb_companies'   => $this->getNbCompanies(),
            'winner'         => [
                'gold'       => $this->getGoldWinner(),
                'ambassador' => $this->getAmbassador(),
                'conviction' => $this->getConviction(),
            ],
        ];

        return view('vitrin.home', ['initialData' => json_encode($data)]);
    }

    // Somme de toutes les collectes passées
    private function getNbCollections(): int
    {
        return Collection::where('end', '<', now())->count();
    }

    // Somme de toutes les entreprises partenaires
    private function getNbCompanies(): int
    {
        return Company::count();
    }

    // Entreprise avec le meilleur ratio nb_blood_pouch/nb_employee sur l'année précédente
    private function getGoldWinner(int $year = null): ?string
    {
        $year = $year ?? Carbon::now()->subYear()->year;

        $companies = Company::with(['collections' => function ($query) use ($year) {
            $query->whereYear('start', $year)
                ->where('end', '<', now())
                ->where('nb_employee', '>', 0);
        }])->get();

        $scores = $companies->map(function ($company) {
            $totalRatio     = $company->collections->sum(fn($c) => $c->nb_blood_pouch / $c->nb_employee);
            $totalBlodPouch = $company->collections->sum('nb_blood_pouch');

            return [
                'name'             => $company->name,
                'ratio'            => $totalRatio,
                'nb_blood_pouch'   => $totalBlodPouch,
            ];
        })->filter(fn($s) => $s['ratio'] > 0);

        return $scores->sortByDesc('ratio')
            ->sortByDesc(fn($s, $key) => [$s['ratio'], $s['nb_blood_pouch']])
            ->first()['name'] ?? null;
    }

    // Entreprise ayant organisé au moins une collecte le plus d'années consécutives (min 2 ans)
    private function getAmbassador(): ?string
    {
        $companies = Company::with(['collections' => function ($query) {
            $query->where('end', '<', now());
        }])->get();

        $scores = $companies->map(function ($company) {
            $years = $company->collections
                ->map(fn($c) => Carbon::parse($c->start)->year)
                ->unique()
                ->sort()
                ->values();

            // Calcul des années consécutives
            $maxConsecutive     = 1;
            $currentConsecutive = 1;
            for ($i = 1; $i < $years->count(); $i++) {
                if ($years[$i] === $years[$i - 1] + 1) {
                    $currentConsecutive++;
                    $maxConsecutive = max($maxConsecutive, $currentConsecutive);
                } else {
                    $currentConsecutive = 1;
                }
            }

            $avgRatio       = $company->collections->where('nb_employee', '>', 0)
                ->avg(fn($c) => $c->nb_blood_pouch / $c->nb_employee) ?? 0;
            $totalBloodPouch = $company->collections->sum('nb_blood_pouch');

            return [
                'name'             => $company->name,
                'consecutive'      => $maxConsecutive >= 2 ? $maxConsecutive : 0,
                'avg_ratio'        => $avgRatio,
                'nb_blood_pouch'   => $totalBloodPouch,
            ];
        })->filter(fn($s) => $s['consecutive'] >= 2);

        return $scores->sortByDesc('consecutive')
            ->sortByDesc('avg_ratio')
            ->sortByDesc('nb_blood_pouch')
            ->first()['name'] ?? null;
    }

    // Entreprise avec le meilleur ratio nb_blood_pouch/nb_registered sur une collecte l'année dernière
    private function getConviction(int $year = null): ?string
    {
        $year = $year ?? Carbon::now()->subYear()->year;

        $collections = Collection::with('company')
            ->whereYear('start', $year)
            // ->where('end', '<', now())
            ->where('nb_registered', '>', 0)
            // ->whereNotNull('nb_blood_pouch')
            ->get();

        if ($collections->isEmpty()) {
            return null;
        }

        $best = $collections
            ->map(fn($c) => [
                'name'  => $c->company->name,
                'ratio' => $c->nb_blood_pouch / $c->nb_registered,
            ])
            ->sortByDesc('ratio')
            ->first();

        return $best['name'] ?? null;
    }
}
