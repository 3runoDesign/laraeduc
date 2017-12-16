<?php

namespace SON\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SON\Forms\UserSettingForm;
use SON\Http\Controllers\Controller;

class UsersSettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit() {
        $form = \FormBuilder::create(UserSettingForm::class, [
            'url' => route('admin.users.settings.update'),
            'method' => 'PUT'
        ]);
        return view('admin.users.settings', compact('form'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $form = \FormBuilder::create(UserSettingForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $data['password'] = bcrypt($data['password']);
        \Auth::user()->update($data);
        $request->session()->flash('message', 'Senha alterada com sucesso');

        return redirect()->route('admin.users.settings.edit');
    }
}
