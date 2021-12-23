<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GymLocation\BulkDestroyGymLocation;
use App\Http\Requests\Admin\GymLocation\DestroyGymLocation;
use App\Http\Requests\Admin\GymLocation\IndexGymLocation;
use App\Http\Requests\Admin\GymLocation\StoreGymLocation;
use App\Http\Requests\Admin\GymLocation\UpdateGymLocation;
use App\Models\GymLocation;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GymLocationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexGymLocation $request
     * @return array|Factory|View
     */
    public function index(IndexGymLocation $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(GymLocation::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.gym-location.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.gym-location.create');

        return view('admin.gym-location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGymLocation $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreGymLocation $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the GymLocation
        $gymLocation = GymLocation::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/gym-locations'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/gym-locations');
    }

    /**
     * Display the specified resource.
     *
     * @param GymLocation $gymLocation
     * @throws AuthorizationException
     * @return void
     */
    public function show(GymLocation $gymLocation)
    {
        $this->authorize('admin.gym-location.show', $gymLocation);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GymLocation $gymLocation
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(GymLocation $gymLocation)
    {
        $this->authorize('admin.gym-location.edit', $gymLocation);


        return view('admin.gym-location.edit', [
            'gymLocation' => $gymLocation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGymLocation $request
     * @param GymLocation $gymLocation
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateGymLocation $request, GymLocation $gymLocation)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values GymLocation
        $gymLocation->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/gym-locations'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/gym-locations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyGymLocation $request
     * @param GymLocation $gymLocation
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyGymLocation $request, GymLocation $gymLocation)
    {
        $gymLocation->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyGymLocation $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyGymLocation $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    GymLocation::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
