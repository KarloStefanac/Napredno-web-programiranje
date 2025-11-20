<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    // Prikaz forme za kreiranje novog projekta
    public function create()
    {
        // Dohvati sve korisnike osim trenutnog (za članove tima)
        $users = User::where('id', '!=', auth()->id())->get();

        return view('projekti.create', compact('users'));
    }

    // Spremanje novog projekta
    public function store(Request $request)
    {
        $request->validate([
            'naziv_projekta' => 'required|string|max:255',
            'opis_projekta' => 'nullable|string',
            'cijena_projekta' => 'nullable|numeric',
            'obavljeni_poslovi' => 'nullable|string',
            'datum_pocetka' => 'nullable|date',
            'datum_zavrsetka' => 'nullable|date|after_or_equal:datum_pocetka',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id'
        ]);

        // Kreiraj projekt i postavi voditelja na trenutno prijavljenog korisnika
        $project = Project::create([
            'naziv_projekta' => $request->naziv_projekta,
            'opis_projekta' => $request->opis_projekta,
            'cijena_projekta' => $request->cijena_projekta,
            'obavljeni_poslovi' => $request->obavljeni_poslovi,
            'datum_pocetka' => $request->datum_pocetka,
            'datum_zavrsetka' => $request->datum_zavrsetka,
            'user_id' => auth()->id(),
        ]);

        // Dodaj članove tima (ako ih je odabrano)
        if ($request->filled('members')) {
            $project->members()->sync($request->members);
        }

        return redirect()->route('projekti.create')->with('success', 'Projekt je uspješno kreiran!');
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        $users = User::where('id', '!=', auth()->id())->get();

        return view('projekti.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $user = auth()->user();

        if ($project->user_id === $user->id) {
            // Voditelj mijenja sve
            $data = $request->validate([
                'naziv_projekta' => 'required|string|max:255',
                'opis_projekta' => 'nullable|string',
                'cijena_projekta' => 'nullable|numeric',
                'obavljeni_poslovi' => 'nullable|string',
                'datum_pocetka' => 'nullable|date',
                'datum_zavrsetka' => 'nullable|date|after_or_equal:datum_pocetka',
            ]);
            $project->update($data);

            if ($request->filled('members')) {
                $project->members()->sync($request->members);
            }
        } else {
            // Član tima mijenja samo obavljene poslove
            $data = $request->validate([
                'obavljeni_poslovi' => 'nullable|string',
            ]);
            $project->update($data);
        }

        return redirect()->route('projekti.edit', $project)->with('success', 'Projekt je uspješno ažuriran!');
    }
    // Brisanje projekta (samo voditelj)
    public function destroy(Project $project)
    {
        if (auth()->id() !== $project->user_id) {
            abort(403, 'Nemaš dozvolu za brisanje ovog projekta.');
        }

        $project->delete();

        return redirect()->route('projekti.index')->with('success', 'Projekt je obrisan.');
    }

}
