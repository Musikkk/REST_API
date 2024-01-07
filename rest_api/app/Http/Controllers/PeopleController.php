<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index()
    {
        $people = People::all();
        return view('people.index', compact('people'));
    }

    public function show($id)
    {
        $person = People::find($id);

        if ($person) {
            return view('people.show', compact('person'));
        } else {
            return response()->view('errors.404', [], 404);
        }
    }

    public function destroy($id)
    {
        $person = People::find($id);

        if ($person) {
            $person->delete();

            return redirect()->route('people.index')->with('success', 'Osoba została usunięta pomyślnie!');
        } else {
            // Obsługa przypadku, gdy nie znaleziono osoby o podanym ID
            return response()->view('errors.404', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            // Dodaj inne reguły walidacji według potrzeb
        ]);

        $person = People::find($id);

        if ($person) {
            // Aktualizuj właściwości osoby na podstawie danych z żądania
            $person->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone_number' => $request->input('phone_number'),
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                // Dodaj inne właściwości do aktualizacji według potrzeb
            ]);

            return redirect()->route('people.show', ['id' => $person->id])->with('success', 'Osoba została zaktualizowana pomyślnie!');
        } else {
            // Obsługa przypadku, gdy nie znaleziono osoby o podanym ID
            return response()->view('errors.404', [], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            // Dodaj inne reguły walidacji według potrzeb
        ]);

        // Utwórz nową osobę na podstawie danych z żądania
        $person = People::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone_number' => $request->input('phone_number'),
            'street' => $request->input('street'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            // Dodaj inne właściwości według potrzeb
        ]);

        return redirect()->route('people.show', ['id' => $person->id])->with('success', 'Osoba została dodana pomyślnie!');
    }
}
