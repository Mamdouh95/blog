<?php
/**
* @author Mamdouh Magdy <mamdouhmagdy95@gmail.com>
*/
namespace App\Http\Controllers;

use App\Http\Requests\ProfileFirstTimeUpdateRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Complete Profile with Required Data ( Gender )
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function complete()
    {
        return view('user.profile_complete');
    }

    /**
     * Complete Profile Data Update
     *
     * @param ProfileFirstTimeUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completeUpdate(ProfileFirstTimeUpdateRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->update($request->only('gender'));
        return redirect()->route('home');
    }

}
