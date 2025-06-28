<?php


namespace App\Http\Controllers\tontiflex\tontine;

use App\Constants\Roles;
use App\Http\Controllers\Controller;
use App\Http\Requests\TontineRequest;
use App\Models\Invitation;
use App\Models\Tontine;
use App\Models\User;
use App\Services\InvitationServices;
use App\Services\PaiementServices;
use App\Services\TontineServices;
use App\Services\WalletTontineServices;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TontineController extends Controller
{
    use AuthorizesRequests;
    private $tontineServices;
    private $invitationServices;
    protected $walletTontineServices;
    protected $paiementServices;




    public function __construct(TontineServices $tontineServices, InvitationServices $InvitationServicesService, WalletTontineServices $walletTontineServices, PaiementServices $paiementServices)
    {
        $this->tontineServices = $tontineServices;
        $this->invitationServices = $InvitationServicesService;
        $this->walletTontineServices = $walletTontineServices;
        $this->paiementServices = $paiementServices;
    }

    public function index()
    {
        $tontines = $this->tontineServices->getUserTontines();
        $users = User::where('id', '!=', Auth::id())
            ->select('id', 'email', 'username', 'image')
            ->orderBy('email')
            ->take(10)
            ->get();


        return view('pages.dashboard.tontines.dashboard-tontine', compact('tontines', 'users'));
    }

    public function tontinecreatevew()
    {
        $tontines = $this->tontineServices->getUserTontines();
        $membres = $this->tontineServices->getUserTontines();

        $currentUser = Auth::user();

        $users = User::where('id', '!=', $currentUser->id)->get();

        return view('pages.dashboard.tontines.my-tontine', compact('tontines', 'users'));
    }

    public function create()
    {
        return view('pages.tontines.create');
    }

    public function store(TontineRequest $request)
    {

        $tontine = $this->tontineServices->createTontine($request->validated());

        return redirect()->route('tontines-tontines', $tontine->id)
            ->with('success', 'Tontine créée avec succès');
    }

    public function show($id)
    {
        $data = $this->tontineServices->getTontineDetails($id);
        $tontinewallets = $this->walletTontineServices->getWalletTontines($id);
        $paiements = $this->paiementServices->getPaiements($id);

        $tontine = $data['tontine'];
        $startDate = $tontine->startDate; // ex: '2025-06-01'
        $frequency = $tontine->contribution_frequency; // 'hebdo', 'monthly', etc.
        $members = $tontine->membres; // Collection d'utilisateurs (avec photo, nom)

        $calendarEvents = [
            [
                'date' => '2025-06-10',
                'name' => 'Alice',
                'photo' => asset('storage/avatars/alice.jpg')
            ],
            [
                'date' => '2025-07-10',
                'name' => 'Bob',
                'photo' => asset('storage/avatars/bob.jpg')
            ],
            // ...
        ];

        return view('pages.tontineview.main.index-tontine-main', compact('data', 'tontinewallets', 'paiements', 'calendarEvents'));
    }

    public function edit($id)
    {
        $tontine = $this->tontineServices->getTontineDetails($id)['tontine'];
        return view('pages.tontines.edit', compact('tontine'));
    }

    public function update(TontineRequest $request, $id)
    {

        $this->tontineServices->updateTontine($id, $request->validated());

        return redirect()->route('tontines-tontines')
            ->with('success', 'Tontine mise à jour avec succès');
    }

    public function destroy($id)
    {
        $tontine = Tontine::findOrFail($id);

        $this->authorize('delete', $tontine);

        $this->tontineServices->deleteTontine($id);
        return redirect()->route('tontines-tontines')
            ->with('success', 'Tontine supprimée avec succès');
    }

    public function archived()
    {
        $tontines = $this->tontineServices->getArchivedTontines();
        return view('pages.dashboard.tontines.archived', compact('tontines'));
    }

    public function restore($id)
    {
        $this->tontineServices->restoreTontine($id);

        return redirect()->route('tontines-archived')
            ->with('success', 'Tontine restaurée avec succès');
    }

    public function deletePermanentlyTontine($id)
    {
        $this->tontineServices->deletePermanentlyTontine($id);

        return redirect()->route('tontines-archived')
            ->with('success', 'Tontine restaurée avec succès');
    }

    public function assignRoleToMember($user_id, $tontine_id, Request $request)
    {
        $user = User::findOrFail($user_id);
        $role = $request->input('role');

        $this->tontineServices->assignRoleToMember($user, $tontine_id, $role);

        return back()->with('message', 'Le rôle à été assigné');
    }

    public function addMemberToTontine(Request $request)
    {
        $tontine_id = $request->input('tontine_id');
        $user_id = $request->input('user_id');
        $action = $request->input('action');
        $invitation_id = $request->input('invitation_id');


        $invitation = Invitation::findOrFail($invitation_id);

        $this->tontineServices->addMember($tontine_id, $user_id, $invitation->id);


        $invitations = $this->invitationServices->getAllInvitations();


        return view('pages.dashboard.invitations.index-invitations', compact('invitations', 'action'));
    }
}
