<?php

namespace App\Http\Controllers;

use App\Models\SocialMediaSettings;
use Illuminate\Http\Request;

class SocialMediaSettingsController extends Controller
{
    public function index()
    {
        $social_media_settings = SocialMediaSettings::all();
        return view('admin.social_media_settings.index', compact('social_media_settings'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'direction_name' => 'required',
            'synonym' => 'required',
        ]);

        SocialMediaSettings::create($request->all());

        return redirect()->route('social_media_settings.index')->with('success', 'SocialMediaSettings created successfully.');
    }

    public function update(Request $request, SocialMediaSettings $zon)
    {
        $request->validate([
            'show_in_the_application' => 'required',
            'youtube_page' => 'required',
            'facebook_page' => 'required',
            'instagram_page' => 'required',
            'linkedIn_page' => 'required',
            'tweeter_page' => 'required',
        ]);
        
        $social_media_settings = SocialMediaSettings::find($request->input('id'));
        $social_media_settings->show_in_the_application = $request->input('show_in_the_application');
        $social_media_settings->youtube_page = $request->input('youtube_page');
        $social_media_settings->facebook_page = $request->input('facebook_page');
        $social_media_settings->instagram_page = $request->input('instagram_page');
        $social_media_settings->linkedIn_page = $request->input('linkedIn_page');
        $social_media_settings->tweeter_page = $request->input('tweeter_page');
        $social_media_settings->update();

        return redirect()->route('social_media_settings.index')->with('success', 'SocialMediaSettings updated successfully');
    }

    public function destroy(Request $request, SocialMediaSettings $social_media_settings)
    {
        $social_media_settings = SocialMediaSettings::find($request->input('id'));
        $social_media_settings->delete();
        
        return redirect()->route('social_media_settings.index')->with('success', 'SocialMediaSettings deleted successfully');
    }
}
