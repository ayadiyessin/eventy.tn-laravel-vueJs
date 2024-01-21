<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TelephoneController;
use App\Http\Controllers\OrganisateurController;
use App\Http\Controllers\RestaurationController;
use App\Http\Controllers\CategorieRestController;
use App\Http\Controllers\CategorieEventController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\AvisPubController;
use App\Http\Controllers\AvisEvenController;
use App\Http\Controllers\NotePubController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\PaymentController;
// Participants
Route::middleware('api')->group(function () {
    Route::resource('Participants', ParticipantController::class);
});
Route::get('/Partic/{iduser}',[ParticipantController::class,'showParticipantByUser']);

//telephones
Route::middleware('api')->group(function () {
    Route::resource('telephones', TelephoneController::class);
});
Route::get('/Tell/{iduser}',[TelephoneController::class,'showTelephoneByUser']);
// organisateur
Route::middleware('api')->group(function () {
    Route::resource('organisateurs', OrganisateurController::class);
});
Route::get('/Org/{iduser}',[OrganisateurController::class,'showOrganisateurByUser']);
// restauration
Route::middleware('api')->group(function () {
    Route::resource('Restauration', RestaurationController::class);
});
Route::get('/Rest/{iduser}',[RestaurationController::class,'showRestaurationByUser']);

Route::get('/RestCateg/{categorieRestID}',[RestaurationController::class,'showRestaurationBycategorieRest']);

// categorieRest
Route::middleware('api')->group(function () {
    Route::resource('CategorieRest', CategorieRestController::class);
});

// CategorieEvent
Route::middleware('api')->group(function () {
    Route::resource('CategorieEvent', CategorieEventController::class);
});

//user
Route::middleware('api')->group(function () {
    Route::resource('users', UserController::class);
});
// evenement
Route::middleware('api')->group(function () {
    Route::resource('Evenement', EvenementController::class);
});
Route::get('/EventOrg/{orgID}',[EvenementController::class,'showEvenementByOrg']);

Route::get('/EventCteg/{categID}',[EvenementController::class,'showEvenementBycateg']);

// Ticket
Route::middleware('api')->group(function () {
    Route::resource('Ticket', TicketController::class);
});
Route::get('/Tickevent/{eventID}',[TicketController::class,'showTicketByEvent']);

Route::get('/tickpart/{partID}',[TicketController::class,'showTicketByPart']);
Route::get('/tickpartevent/{partId}/{eventID}', [TicketController::class, 'showtickbypartEvent']);// Index route

// publication
Route::middleware('api')->group(function () {
    Route::resource('Publication', PublicationController::class);
});
Route::get('/pub/{resID}',[PublicationController::class,'showPublicationByRes']);
Route::put('desarchiver/{id}', [PublicationController::class, 'desarchiver']);// Update route
Route::put('archiver/{id}', [PublicationController::class, 'archiver']);// Update route




//avispub => commentaire => pour publication
Route::get('listeCompub/{partId}/{publId}', [AvisPubController::class, 'index']);// Index route
Route::get('listeComParpub/{publId}', [AvisPubController::class, 'listeCommentaires']);// liste comentaire
Route::post('AjoutCompub/{partId}/{publId}', [AvisPubController::class, 'store']);// Store route
Route::put('updateCompub/{id}', [AvisPubController::class, 'update']);// Update route
Route::delete('delateCompub/{id}', [AvisPubController::class, 'destroy']);// Destroy route

//AvisEven => commentaire => pour evenement
Route::get('listeComEven/{partId}/{eventID}', [AvisEvenController::class, 'index']);// Index route
Route::get('listeComParEven/{eventID}', [AvisEvenController::class, 'listeCommentaires']);// liste comentaire
Route::post('AjoutComEven/{partId}/{eventID}', [AvisEvenController::class, 'store']);// Store route
Route::put('updateComEven/{id}', [AvisEvenController::class, 'update']);// Update route
Route::delete('delateComEven/{id}', [AvisEvenController::class, 'destroy']);// Destroy route

//NotePub => note => pour publication
Route::get('notePub/{partId}/{publId}', [NotePubController::class, 'index']);// Index route
Route::get('moyenNote/{publId}', [NotePubController::class, 'Moyenenotes']);// liste comentaire
Route::post('AjoutNotepub/{partId}/{publId}', [NotePubController::class, 'store']);// Store route
Route::put('updateNotepub/{id}', [NotePubController::class, 'update']);// Update route
Route::delete('delateNotepub/{id}', [NotePubController::class, 'destroy']);// Destroy route
Route::get('Countnotes/{publId}', [NotePubController::class, 'Countnotes']);// liste comentaire

//login
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class,'logout']);

//payement
Route::middleware('api')->group(function($router) {
    Route::post('/createpayment', [PaymentController::class,'createPaymentIntent']);
});
