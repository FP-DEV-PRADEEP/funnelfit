<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GymStaffType\BulkDestroyGymStaffType;
use App\Http\Requests\Admin\GymStaffType\DestroyGymStaffType;
use App\Http\Requests\Admin\GymStaffType\IndexGymStaffType;
use App\Http\Requests\Admin\GymStaffType\StoreGymStaffType;
use App\Http\Requests\Admin\GymStaffType\UpdateGymStaffType;
use App\Models\GymStaffType;
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

class GymStaffTypesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexGymStaffType $request
     * @return array|Factory|View
     */
    public function index(IndexGymStaffType $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(GymStaffType::class)->processRequestAndGet(
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

        return view('admin.gym-staff-type.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.gym-staff-type.create');

        return view('admin.gym-staff-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGymStaffType $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreGymStaffType $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the GymStaffType
        $gymStaffType = GymStaffType::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/gym-staff-types'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/gym-staff-types');
    }

    /**
     * Display the specified resource.
     *
     * @param GymStaffType $gymStaffType
     * @throws AuthorizationException
     * @return void
     */
    public function show(GymStaffType $gymStaffType)
    {
        $this->authorize('admin.gym-staff-type.show', $gymStaffType);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GymStaffType $gymStaffType
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(GymStaffType $gymStaffType)
    {
        $this->authorize('admin.gym-staff-type.edit', $gymStaffType);


        return view('admin.gym-staff-type.edit', [
            'gymStaffType' => $gymStaffType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGymStaffType $request
     * @param GymStaffType $gymStaffType
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateGymStaffType $request, GymStaffType $gymStaffType)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values GymStaffType
        $gymStaffType->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/gym-staff-types'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/gym-staff-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyGymStaffType $request
     * @param GymStaffType $gymStaffType
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyGymStaffType $request, GymStaffType $gymStaffType)
    {
        $gymStaffType->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyGymStaffType $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyGymStaffType $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    GymStaffType::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
