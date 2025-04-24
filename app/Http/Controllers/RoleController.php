<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Role as SpatieRole;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $roles = SpatieRole::paginate();

        return view('role.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * $roles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $role = new Role();

        return view('role.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        $all = $request->validated();
        $all['guard_name'] = "web";
        Role::create($all);

        return Redirect::route('roles.index')
            ->with('success', 'Role a été créé(e) avec succes !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $role = SpatieRole::findOrFail($id);

        $rolePermissions = $role->permissions()->pluck('id')->toArray();
        // dd($rolePermissions);
        $allPermissions = \Spatie\Permission\Models\Permission::all();
        return view('role.show', compact('role', 'rolePermissions', 'allPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $role = Role::find($id);

        return view('role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        if ($role->name === 'Super-admin') {
            return Redirect::route('roles.index')
                ->with('error', 'Vous ne pouvez pas modifier ce role !');
        }
        $role->update($request->validated());

        return Redirect::route('roles.index')
            ->with('success', 'Role a été mis(e) à jour avec succes !');
    }

    public function destroy($id): RedirectResponse
    {

        $role = Role::find($id);
        if ($role->name === 'Super-admin') {
            return Redirect::route('roles.index')
                ->with('error', 'Vous ne pouvez pas supprimer ce role !');
        }
        $role->delete();
        return Redirect::route('roles.index')
            ->with('success', 'Role a été supprimé(e) avec succes !');
    }
    function storePermissions(Request $request, SpatieRole $role): RedirectResponse
    {
        // dd($role, $request->permissions, $request->all());
        $role->syncPermissions($request->permissions);

        return Redirect::route('roles.index')
            ->with('success', 'Permissions ont été mis à jour avec succes !');
    }
}
