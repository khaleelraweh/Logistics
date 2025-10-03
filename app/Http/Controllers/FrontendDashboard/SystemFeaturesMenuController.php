<?php

namespace App\Http\Controllers\FrontendDashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontendDashboard\SystemFeaturesMenuRequest;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SystemFeaturesMenuController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('frontend_dashboard', 'manage_system_features_menus , show_system_features_menus')) {
            return redirect('frontend_dashboard/index');
        }

        $system_features_menus = Menu::query()->where('section', 2)
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderByRaw(request()->sort_by == 'published_on'
                ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
            ->paginate(\request()->limit_by ?? 100);

        return view('frontend_dashboard.system_features_menus.index', compact('system_features_menus'));
    }

    public function create()
    {
        if (!auth()->user()->ability('frontend_dashboard', 'create_system_features_menus')) {
            return redirect('frontend_dashboard/index');
        }

        return view('frontend_dashboard.system_features_menus.create');
    }

    public function store(SystemFeaturesMenuRequest $request)
    {
        if (!auth()->user()->ability('frontend_dashboard', 'create_system_features_menus')) {
            return redirect('frontend_dashboard/index');
        }

        $input['title'] = $request->title;
        $input['description'] = $request->description;
        $input['link'] = $request->link;
        $input['icon'] = $request->icon;

        $input['section']    = 2;

        $input['metadata_title'] = [];
        foreach (config('locales.languages') as $localeKey => $localeValue) {
            $input['metadata_title'][$localeKey] = $request->metadata_title[$localeKey]
                ?: $request->title[$localeKey] ?? null;
        }
        $input['metadata_description'] = [];
        foreach (config('locales.languages') as $localeKey => $localeValue) {
            $description = $request->description[$localeKey] ?? '';
            // Remove all tags and decode HTML entities
            $plainDescription = html_entity_decode(strip_tags($description), ENT_QUOTES | ENT_HTML5);
            // Limit to 30 words
            $limitedDescription = implode(' ', array_slice(explode(' ', $plainDescription), 0, 30));
            $input['metadata_description'][$localeKey] = $request->metadata_description[$localeKey]
                ?: $limitedDescription ?: null;
        }
        $input['metadata_keywords'] = $request->metadata_keywords;


        $input['status']     =   $request->status;
        $input['created_by'] = auth()->user()->full_name;

        $published_on = str_replace(['ص', 'م'], ['AM', 'PM'], $request->published_on);
        $publishedOn = Carbon::createFromFormat('Y/m/d h:i A', $published_on)->format('Y-m-d H:i:s');
        $input['published_on']            = $publishedOn;


        $system_features_menu = Menu::create($input);


        if ($system_features_menu) {
            return redirect()->route('frontend_dashboard.system_features_menus.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('frontend_dashboard.system_features_menus.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }


    public function show($id)
    {
        if (!auth()->user()->ability('frontend_dashboard', 'display_system_features_menus')) {
            return redirect('frontend_dashboard/index');
        }
        return view('frontend_dashboard.system_features_menus.show');
    }


    public function edit($SystemFeaturesMenu)
    {
        if (!auth()->user()->ability('frontend_dashboard', 'update_system_features_menus')) {
            return redirect('frontend_dashboard/index');
        }

        $systemFeaturesMenu = Menu::where('id', $SystemFeaturesMenu)->first();

        return view('frontend_dashboard.system_features_menus.edit', compact('systemFeaturesMenu'));
    }

    public function update(SystemFeaturesMenuRequest $request,  $SystemFeaturesMenu)
    {
        if (!auth()->user()->ability('frontend_dashboard', 'update_system_features_menus')) {
            return redirect('frontend_dashboard/index');
        }

        $SystemFeaturesMenu = Menu::where('id', $SystemFeaturesMenu)->first();

        $input['title']     = $request->title;
        $input['link']      = $request->link;
        $input['icon']      = $request->icon;
        $input['section']    = 2;

        $input['metadata_title'] = [];
        foreach (config('locales.languages') as $localeKey => $localeValue) {
            $input['metadata_title'][$localeKey] = $request->metadata_title[$localeKey]
                ?: $request->title[$localeKey] ?? null;
        }
        $input['metadata_description'] = [];
        foreach (config('locales.languages') as $localeKey => $localeValue) {
            $description = $request->description[$localeKey] ?? '';
            // Remove all tags and decode HTML entities
            $plainDescription = html_entity_decode(strip_tags($description), ENT_QUOTES | ENT_HTML5);
            // Limit to 30 words
            $limitedDescription = implode(' ', array_slice(explode(' ', $plainDescription), 0, 30));
            $input['metadata_description'][$localeKey] = $request->metadata_description[$localeKey]
                ?: $limitedDescription ?: null;
        }
        $input['metadata_keywords'] = $request->metadata_keywords;


        $input['status']    =   $request->status;
        $input['updated_by'] =   auth()->user()->full_name;


        $published_on = str_replace(['ص', 'م'], ['AM', 'PM'], $request->published_on);
        $publishedOn = Carbon::createFromFormat('Y/m/d h:i A', $published_on)->format('Y-m-d H:i:s');
        $input['published_on']            = $publishedOn;


        $SystemFeaturesMenu->update($input);

        if ($SystemFeaturesMenu) {
            return redirect()->route('frontend_dashboard.system_features_menus.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('frontend_dashboard.system_features_menus.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function destroy($SystemFeaturesMenu)
    {

        if (!auth()->user()->ability('frontend_dashboard', 'delete_system_features_menus')) {
            return redirect('frontend_dashboard/index');
        }

        $SystemFeaturesMenu = Menu::where('id', $SystemFeaturesMenu)->first();

        $SystemFeaturesMenu->delete();

        if ($SystemFeaturesMenu) {
            return redirect()->route('frontend_dashboard.system_features_menus.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('frontend_dashboard.system_features_menus.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function updateSystemFeaturesMenuStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Menu::where('id', $data['system_features_menu_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'system_features_menu_id' => $data['system_features_menu_id']]);
        }
    }
}
