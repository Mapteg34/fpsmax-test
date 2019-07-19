<?php

namespace App\Providers;

use App\Http\Resources\LeagueResource;
use App\Http\Resources\MatchResource;
use App\Http\Resources\Resourceable;
use App\Http\Resources\ResourceableEloquentCollection;
use App\Http\Resources\ResourceableLengthAwarePaginator;
use App\Http\Resources\TeamResource;
use App\Models\League;
use App\Models\Match;
use App\Models\Team;
use Countable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;

class ResourceServiceProvider extends ServiceProvider
{
    protected $defaultResources = [
        Team::class   => TeamResource::class,
        League::class => LeagueResource::class,
        Match::class  => MatchResource::class,
    ];

    public function boot()
    {
        $this->app->bind(LengthAwarePaginator::class, function (Application $app, $parameters) {
            return $app->make(ResourceableLengthAwarePaginator::class, $parameters);
        });
        $this->app->bind(Collection::class, function (Application $app, $parameters) {
            return $app->make(ResourceableEloquentCollection::class, $parameters);
        });
        $this->app->bind(JsonResource::class, function (Application $app, $parameters) {
            /** @noinspection PhpUndefinedMethodInspection */
            $modelClass    = $parameters['resource'] instanceof Resourceable
                ? $parameters['resource']->getModelClass()
                : null;
            $collectsClass = $this->defaultResources[$modelClass] ?? null;

            if ($parameters['resource'] instanceof Countable) {
                return new class($collectsClass, $parameters['resource']) extends ResourceCollection
                {
                    public function __construct($collectsClass, $resource)
                    {
                        if ($collectsClass !== null) {
                            $this->collects = $collectsClass;
                        }
                        parent::__construct($resource);
                    }
                };
            } elseif ($collectsClass !== null) {
                return $app->make($collectsClass, $parameters);
            } else {
                return new JsonResource($parameters['resource']);
            }
        });
    }
}
