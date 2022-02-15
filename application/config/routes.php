<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


$route['default_controller'] = 'site/index';
$route['404_override'] = 'site/error';
$route['translate_uri_dashes'] = FALSE;


// Routes for Callbacks 
$route['CallbackRequest'] = 'callbacks/callbackRequest';
$route['ActivationCallback'] = 'callbacks/activationRequest';
$route['PaymentCallback'] = 'callbacks/paymentRequest';
$route['Subscribe'] = 'subscription/index';
$route['Subscribe/(:any)'] = 'subscription/index/$1';


// Routes for Admin
$route['admin'] = 'admin/index';
$route['Admin/Home'] = 'admin/home';
$route['Admin/UpdatePassword'] = 'admin/updatePassword';


$route['Admin/ManageCategories'] = 'admin/getCategories';
$route['Admin/ManageGames'] = 'admin/getGames';
$route['Admin/PlayGame/(:any)'] = 'admin/getPlayGame/$1';
$route['Admin/SuggestedGames'] = 'admin/getSuggestedGames';
$route['Admin/TopGames'] = 'admin/getTopGames';
$route['Admin/GenreGames/(:any)'] = 'admin/getGenreGames/$1';
$route['Admin/PracticeBanners'] = 'admin/getPracticeBanners/$1';
$route['Admin/PrivateTournamentGames'] = 'admin/getPrivateTournamentGames';

$route['Admin/ManageCountry']   =   'admin/manageCountry';
$route['Admin/ManageTournaments'] = 'admin/getTournaments';
$route['Admin/NewTournament'] = 'admin/newTournament';
$route['Admin/EditTournaments/(:any)'] = 'admin/editTournaments/$1';
$route['Admin/TournamentBanners'] = 'admin/tournamentBannersList';
$route['Admin/UploadTournamentBanner'] = 'admin/uploadTournamentBanner';
$route['Admin/EditTournamentBanner'] = 'admin/editTournamentBanner';
$route['Admin/QuickTournaments'] = 'admin/getQuickTournaments';


$route['Admin/Games'] = 'admin/gamesList';
$route['Admin/Games/(:any)'] = 'admin/gamesList/$1';

$route['Admin/SpinWheel'] = 'admin/getSpinWheelSections';
$route['Admin/PortalSettings'] = 'admin/getPortalSettings';
$route['Admin/ManageRedemption'] = 'admin/manageRedemption';



// Routes for Website Live/Custom Tournaments
$route['Home'] = 'site/index';
$route['LiveTournament/(:any)'] = 'site/getLiveTournament/$1';
$route['PlayLiveTournament/(:any)'] = 'site/playLiveTournament/$1';
$route['LiveTournamentLeaderboard/(:any)'] = 'site/getLiveTournamentLeaderboard/$1';
$route['practiceTournamentGame/(:any)/(:any)'] = 'site/practiceTournamentGame/$1/$2';

$route['AllGames'] = 'site/getAllGenreGames';
$route['Games/(:any)'] = 'site/getGenreGames/$1';
$route['playGame/(:any)'] = 'site/playGame/$1';



// Routes for Private Tournaments

$route['createTournament'] = 'site/createTournament';
$route['createTournament/Step-1'] = 'site/tournamentStep1';
$route['createTournament/Step-2/(:any)'] = 'site/tournamentStep2/$1';
$route['createTournament/Step-3/(:any)'] = 'site/tournamentStep3/$1';
$route['Tournaments/(:any)'] = 'site/tournamentInfo/$1';
$route['SHARE/(:any)'] = 'site/sharedTournamentInfo/$1';
$route['TournamentInfo/(:any)'] = 'site/friendTournamentInfo/$1';
$route['TournamentLeaderboard/(:any)'] = 'site/tournamentLeaderboard/$1';
$route['tournamentHistory'] = 'site/tournamentHistory';
$route['customTournament/(:any)'] = 'site/customTournament/$1';

$route['JoinTournament/(:any)'] = 'site/joinTournament/$1';
$route['PlayTournament/(:any)'] = 'site/playTournament/$1';
$route['verifyOTP'] = 'site/verifyOTP';
$route['verifyOTP/(:any)'] = 'site/verifyOTP/$1';


$route['updateProfileImage'] = 'site/updateProfileImage';
$route['Spin-Win'] = 'site/spinWheel';
$route['Login'] = 'site/userLogin';
$route['RedeemCoins'] = 'site/redeemCoins';
$route['ManageProfile'] = 'site/manageProfile';
$route['ManageSubscription']='user_subscription/manageSubscription';
$route['TopupHistory'] = 'user_topup/topupHistory';
$route['Notifications'] = 'site/manageNotifications';
$route['CancelSubscription']='user_subscription/cancelPaymentRequest';
$route['privacy-policy'] = 'site/privacyPolicy';
$route['terms-of-use'] = 'site/terms';
$route['TournamentsList']='site/tournamentsList';
$route['vipList']='site/vipList';


/*
| -------------------------------------------------------------------------
| Sample REST API /Routes
| -------------------------------------------------------------------------
*/
//$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
//$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
