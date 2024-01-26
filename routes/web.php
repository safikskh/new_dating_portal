<?php

use App\User;
use App\Models\Favourite;
use App\Models\Backend\CustomerController;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

$settings_data = DB::table('settings')->first();

Route::get('/getToken', function () {
    return csrf_token();
})->middleware('auth');

Auth::routes(['verify' => true]);
// dd($settings_data);
if ($settings_data->maintenance_status == 1) {
    Route::get('/', 'frontEnd\WelcomeController@maintenance')->name('public.maintenance');
} else {
    //Public
    Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
    Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
    Route::get('/', 'frontEnd\WelcomeController@index')->name('public.home');
    Route::get('/public/faq', 'frontEnd\WelcomeController@faq')->name('public.faq');
    Route::get('/privacy_policy', 'frontEnd\WelcomeController@privacyPolicy')->name('public.pp');
    Route::get('/terms_of_services', 'frontEnd\WelcomeController@termsOfServices')->name('public.tos');
    //Public

    //Signup
    Route::get('/f2', 'frontEnd\SignupController@f2')->name('public.f2');
    Route::get('/f3', 'frontEnd\SignupController@f3')->name('public.f3');
    Route::get('/f5', 'frontEnd\SignupController@f5')->name('public.f5');

    Route::Resource('/signup', 'frontEnd\SignupController');
    Route::get('signupplans', 'frontEnd\SignupController@signupplans')->name('signupplans.show');
    Route::get('membership/{plan}', 'frontEnd\SignupController@showplan')->name('membership.show');
    Route::post('newsubscription', 'frontEnd\SignupController@newMemberCreate')->name('newsubscription.create');
    // Signup

    // Coupon
    Route::post('coupon', 'frontEnd\SignupController@promoCodeStore')->name('coupon.store');
    Route::delete('coupon', 'frontEnd\SignupController@promoCodeDestroy')->name('coupon.destroy');
    Route::get('/portalprices', 'frontEnd\SignupController@portalPrices')->name('portal.prices');
    // Coupon

    // Current Active New Signup
    Route::group(['prefix' => 'signup/v2/'], function () {
        Route::post('second_step', 'frontEnd\SignupController@SecondStep')->name('signup.second');
        Route::post('third_step', 'frontEnd\SignupController@ThirdStep')->name('signup.third');
        Route::post('fort_step', 'frontEnd\SignupController@FortStep')->name('signup.fort');
        Route::get('fifth_step', 'frontEnd\SignupController@FortStepShow')->name('signup.show.fort');
        Route::post('fifth_step', 'frontEnd\SignupController@FifthStepSubmit')->name('signup.submit');
        Route::get('fb/select_portal', 'frontEnd\SignupController@FBPortalSelection')->name('signup.show.fbPortals');
        Route::post('fb/select_portal', 'frontEnd\SignupController@FBPortalSubmit')->name('signup.submit.fbPortals');
    });

    Route::get('complete-profile', 'frontEnd\SignupController@FortStepShow')->name('profile.complete');
    // Current Active New Signup

    //Frontend
    Route::group(['middleware' => ['verified', 'auth']], function () {
        Route::get('home', 'HomeController@index')->name('home');
        Route::get('announcements', 'HomeController@announcementList')->name('frontend.announcement.list');
        Route::get('posts', 'HomeController@postList')->name('frontend.post.list');
        Route::get('block-user-profile', 'HomeController@blockError')->name('blockError');
        Route::Resource('profile', 'frontEnd\ProfileController');
        Route::post('rating', 'frontEnd\ProfileController@ratingProfile')->name('rating');
        Route::get('blockList', 'frontEnd\ProfileController@blockList')->name('blockList');
        Route::post('blockList', 'frontEnd\ProfileController@userBlock')->name('userBlock');
        Route::post('userBlockDelete', 'frontEnd\ProfileController@userBlockDelete')->name('userBlockDelete');
        Route::post('favourite', 'frontEnd\ProfileController@favouriteUser')->name('favourite');
        Route::Resource('status', 'frontEnd\StatusController');
        Route::get('statuses', 'frontEnd\StatusController@statusList');
        Route::post('statuses/{id}/report', 'frontEnd\StatusController@report')->name('status.report');
        Route::post('profileDescription', 'frontEnd\ProfileController@profileDescription');
        Route::post('profile_report', 'frontEnd\ProfileController@profileReport')->name('profile.report');

        Route::get('visited_all', 'frontEnd\ProfileController@visitedAll')->name('visited.all');
        Route::get('favorite_all', 'frontEnd\ProfileController@favoriteAll')->name('favorite.all');
        Route::get('latest_all', 'frontEnd\ProfileController@latestAll')->name('latest.all');

        Route::get('profile_edit', 'frontEnd\ProfileController@profileEditShow')->name('profileEdit.show');

        // Profile Search
        Route::get('search', 'frontEnd\SearchController@search_null')->name('profile.search.null');
        Route::post('search', 'frontEnd\SearchController@search')->name('profile.search');
        Route::get('advance_search', 'frontEnd\SearchController@showAdvanceSearch')->name('show.advancesearch');
        Route::post('advance_search', 'frontEnd\SearchController@postAdvanceSearch')->name('post.advancesearch');

        // Change password
        Route::post('changePassword', 'HomeController@changePassword')->name('changePassword');

        // Portal
        Route::Resource('portals', 'frontEnd\PortalController');

        //Group
        Route::get('groups', 'frontEnd\GroupsController@index')->name('groups');
        Route::get('groupsearch/autocomplete', 'frontEnd\GroupsController@autocomplete');
        Route::get('createGroup', 'frontEnd\GroupsController@store')->name('createGroup');
        Route::get('groupDetails/{id}', 'frontEnd\GroupsController@groupDetails')->name('groupDetails');
        Route::get('joinGroup/{id}', 'frontEnd\GroupsController@joinGroup')->name('joinGroup');
        Route::post('postongroup', 'frontEnd\GroupsController@postongroup')->name('postongroup');
        Route::get('likeGroupPost', 'frontEnd\GroupsController@likeGroupPost')->name('likeGroupPost');
        Route::post('postcommentonthispost', 'frontEnd\GroupsController@postcommentonthispost')->name('postcommentonthispost');
        Route::post('approvedToJoin', 'frontEnd\GroupsController@approvedToJoin')->name('approvedToJoin');
        Route::post('rejectToJoin', 'frontEnd\GroupsController@rejectToJoin')->name('rejectToJoin');

        Route::post('groups', 'frontEnd\GroupsController@search')->name('groupsearch');
        Route::post('/groups/deactive/{id}', 'frontEnd\GroupsController@groupdeactive')->name('group.groupdeactive');
        Route::post('/groups/groupstore', 'frontEnd\GroupsController@groupstore')->name('group.groupstore');
        Route::post('/groups/groupupdate/{id}', 'frontEnd\GroupsController@groupupdate')->name('group.groupupdate');
        Route::get('/groups/groupedit/{id}', 'frontEnd\GroupsController@groupedit')->name('group.groupedit');
        //Group

        //Events
        Route::get('events', 'frontEnd\EventsController@index')->name('events');
        Route::get('eventsearch/autocomplete', 'frontEnd\EventsController@autocomplete');
        Route::get('createEvent', 'frontEnd\EventsController@store')->name('createEvent');
        Route::get('eventDetails/{id}', 'frontEnd\EventsController@eventDetails')->name('eventDetails');
        Route::get('joinEvent/{id}', 'frontEnd\EventsController@joinEvent')->name('joinEvent');

        Route::post('event_post', 'frontEnd\EventsController@eventPost')->name('event.post');
        Route::post('event_post_comment', 'frontEnd\EventsController@eventComment')->name('event.comment');

        Route::post('/events/eventstore', 'frontEnd\EventsController@eventstore')->name('event.eventstore');
        Route::post('/events/eventupdate/{id}', 'frontEnd\EventsController@eventupdate')->name('event.eventupdate');
        Route::get('/events/eventedit/{id}', 'frontEnd\EventsController@eventedit')->name('event.eventedit');
        Route::post('/events/deactive/{id}', 'frontEnd\EventsController@eventdeactive')->name('event.eventdeactive');

        Route::post('events', 'frontEnd\EventsController@search')->name('eventsearch');
        //Events

        //Blog
        Route::get('blogs', 'frontEnd\BlogsController@index')->name('blogs');
        Route::post('blogs', 'frontEnd\BlogsController@search')->name('blogsearch');
        Route::post('/blogs/deactive/{id}', 'frontEnd\BlogsController@blogdeactive')->name('blog.blogdeactive');
        Route::post('/blogs/blogstore', 'frontEnd\BlogsController@blogstore')->name('blog.blogstore');
        Route::post('/blogs/blogupdate/{id}', 'frontEnd\BlogsController@blogupdate')->name('blog.blogupdate');
        Route::get('/blogs/blogedit/{id}', 'frontEnd\BlogsController@blogedit')->name('blog.blogedit');

        Route::get('blogsearch/autocomplete', 'frontEnd\BlogsController@autocomplete');
        Route::get('createBlog', 'frontEnd\BlogsController@store')->name('createBlog');
        Route::get('blogDetails/{id}', 'frontEnd\BlogsController@blogDetails')->name('blogDetails');
        Route::post('/blogs/comment', 'frontEnd\BlogCommentsController@store')->name('blog.comment');

        Route::post('/blogs/post/store', 'frontEnd\BlogsController@poststore')->name('blog.post.store');
        Route::post('/blogs/post/imagecrop', 'frontEnd\BlogsController@imagecrop')->name('blog.post.imagecrop');
        //Blog

        // Chat Routes
        Route::post('user_chat', 'ChatController@userChat')->name('user.chat');
        Route::get('latest_chat', 'ChatController@latestMessage')->name('latest.chat');
        Route::get('chat/{id?}', 'ChatController@chat')->name('chat');
        Route::get('favchat/{id?}', 'ChatController@favchat')->name('favchat');
        Route::get('chat_users', 'ChatController@userList')->name('chat.users');
        Route::get('get_auth', 'ChatController@getAuth');
        Route::get('user_messages/{user}', 'ChatController@getMessages')->name('single.user.chat');
        Route::get('last_message/{id}', 'ChatController@getLastMessage')->name('last.message');
        Route::get('read_messages/{id}', 'ChatController@readMessages')->name('read.messages');
        Route::get('read_messages_home/{type}/{id}', 'ChatController@readMessageshome')->name('read.messageshome');
        Route::get('get_message_info/{id}', 'ChatController@getMessageInfo')->name('get.message');
        Route::post('delete_all_messages', 'ChatController@deleteAllByUser')->name('deleteAll.message');
        Route::post('delete_messages_by_id', 'ChatController@deleteById')->name('delete.message');
        // Chat Routes

        //File Upload Route
        Route::post('imageUpload', 'frontEnd\FileUploadController@imageUpload')->name('imageUpload');
        Route::post('videoUpload', 'frontEnd\FileUploadController@videoUpload')->name('videoUpload');
        Route::get('showUploadImageAll', 'frontEnd\FileUploadController@showUploadImageAll')->name('showUploadImageAll');
        Route::get('showUploadImageMen', 'frontEnd\FileUploadController@showUploadImageMen')->name('showUploadImageMen');
        Route::get('showUploadImageWomen', 'frontEnd\FileUploadController@showUploadImageWomen')->name('showUploadImageWomen');
        Route::get('showUploadImageCouple', 'frontEnd\FileUploadController@showUploadImageCouple')->name('showUploadImageCouple');
        Route::get('delete_image/{id}', 'frontEnd\FileUploadController@destroyImage')->name('destroy.image');
        //File Upload Route

        //Video
        Route::get('showUploadVideoAll', 'frontEnd\FileUploadController@showUploadVideoAll')->name('showUploadVideoAll');
        Route::get('showUploadVideoMen', 'frontEnd\FileUploadController@showUploadVideoMen')->name('showUploadVideoMen');
        Route::get('showUploadVideoWomen', 'frontEnd\FileUploadController@showUploadVideoWomen')->name('showUploadVideoWomen');
        Route::get('showUploadVideoCouple', 'frontEnd\FileUploadController@showUploadVideoCouple')->name('showUploadVideoCouple');
        //Video

        Route::get('createVideoconference', 'frontEnd\VideoRoomController@getVideoRoom')->name('createVideoconference');
        Route::get('web-cam', 'frontEnd\VideoRoomController@webCam')->name('webCam');
        // Route::get('joinVideoconference', 'frontEnd\VidroomeoRoomController@joinRoom')->name('joinVideoconference');
        Route::post('video-room/create', 'frontEnd\VideoRoomController@createRoom')->name('createVideoRoom');
        Route::post('gender-filter', 'frontEnd\VideoRoomController@genderFilter')->name('gender-filter');
        Route::get('room/{id}', 'frontEnd\VideoRoomController@getRoom')->name('getRoom');
        Route::post('chat', 'frontEnd\VideoRoomController@doChat')->name('postChat');
        Route::post('chat/all', 'frontEnd\VideoRoomController@allChat')->name('allChat');
        Route::get('web-change-status', 'frontEnd\VideoRoomController@webChangeStatus')->name('web-change-status');
        //Faq

        // web cam
        Route::get('createChatRoom', 'frontEnd\ChatController@createChatRoom')->name('createChatRoom');
        Route::post('chat-room/create', 'frontEnd\ChatController@createChat')->name('createChat');
        Route::get('chatroom/{id}', 'frontEnd\ChatController@getWebRoom')->name('getWebRoom');
        Route::get('chat-change-status', 'frontEnd\ChatController@chatChangeStatus')->name('chat-change-status');


        Route::get('faq', 'frontEnd\FileUploadController@faq')->name('faq');

        //Chat Room
        Route::get('chat-test', 'frontEnd\ChatRoomController@test')->name('chatroom.test');
        Route::get('chat-rooms', 'frontEnd\ChatRoomController@index')->name('chatroom.index');
        Route::get('chat-rooms/{id}', 'frontEnd\ChatRoomController@chat')->name('chatroom.chat');
        Route::get('chat-rooms/messages/{id}', 'frontEnd\ChatRoomController@fetchAllMessages')->name('chatroom.fetchAllMessages');
        Route::post('chat-rooms/messages', 'frontEnd\ChatRoomController@sendMessage')->name('chatroom.sendMessage');

        // Route::Resource('chat-rooms', 'frontEnd\ChatRoomController');
        Route::Resource('chatRoomjoin', 'frontEnd\ChatRoomJoinUserController');
        Route::post('chat-rooms/send', 'frontEnd\ChatRoomController@send');
        Route::post('saveToSession', 'frontEnd\ChatRoomController@saveToSession');
        Route::post('chat-rooms/getOldMessage', 'frontEnd\ChatRoomController@getOldMessage');
        Route::post('checkUser', 'frontEnd\ChatRoomController@checkCurrentChatRoomAndPortalUser');
        Route::post('chat-rooms/checkEventUser', 'frontEnd\ChatRoomController@checkEventUser');
        //Chat Room

        // Stripe
        Route::get('plans', 'frontEnd\MembershipController@index')->name('plans.index');
        Route::get('plan/{plan}', 'frontEnd\MembershipController@show')->name('plans.show');
        Route::post('subscription', 'frontEnd\SubscriptionController@create')->name('subscription.create');

        Route::get('statusplan/{plan}', 'frontEnd\StatusController@statusplan')->name('statusplan.show');
        Route::post('statusplan', 'frontEnd\StatusController@statusplancreate')->name('statusplan.create');

        Route::get('promotions', 'frontEnd\PromotionController@index')->name('promotion.list');
        Route::get('promotionplans', 'frontEnd\PromotionController@promotionplans')->name('promotionplans');
        Route::get('promotionplan', 'frontEnd\PromotionController@promotionplan')->name('promotionplan.show');
        Route::post('promotionplan', 'frontEnd\PromotionController@promotionplancreate')->name('promotionplan.create');

        Route::post('promotions/start', 'frontEnd\PromotionController@promotionstart')->name('promotion.start');

        Route::get('portalplan/{plan}', 'frontEnd\PortalController@portalplan')->name('portalplan.show');
        Route::post('portalplan', 'frontEnd\PortalController@portalplancreate')->name('portalplan.create');

        Route::get('chat_plans', 'ChatController@index')->name('chatplans.chat');
        Route::get('chatplan/{plan}', 'ChatController@chatplan')->name('chatplan.show');
        Route::post('chatplan', 'ChatController@chatplancreate')->name('chatplan.create');
        // Stripe

        //Notification
        Route::get('markAsRead/{id}', function ($id) {
            if (auth()->user()->unreadNotifications->find($id)->markAsRead()) {
                if ($request->ajax()) return response()->json('success', 200);
            }
        });
        Route::post('notifRead', function (Request $request) {
            if (auth()->user()->unreadNotifications->find($request->id)->markAsRead()) {
                if ($request->ajax()) return response()->json('success', 200);
            }
        });
        Route::get('markUserAsRead/{id}', function ($id) {
            if (User::find($id)->unreadNotifications->markAsRead()) {
                return true;
            }
        });
        Route::get('favoriteusers', function () {
            return Favourite::where('favourite_by', auth()->id())->get();
        });
        //Notification

        // Setting
        Route::get('profileprivacy', 'frontEnd\SettingController@index')->name('privacy.setting.show');
        Route::post('profileprivacy', 'frontEnd\SettingController@updatePrivacy')->name('privacy.setting.update');
        Route::get('pushnotification', 'frontEnd\SettingController@pushnotificationShow')->name('push.setting.show');
        Route::post('pushnotification', 'frontEnd\SettingController@updatePushnotification')->name('push.setting.update');

        Route::get('email_settings', 'frontEnd\SettingController@emailSettingShow')->name('email.setting.show');
        Route::post('email_settings', 'frontEnd\SettingController@emailSettingUpdate')->name('email.setting.update');

        Route::get('profile_security', 'frontEnd\SettingController@security')->name('security.setting.show');
        Route::post('profile_security', 'frontEnd\SettingController@updateSecurityy')->name('security.setting.delete');
        Route::post('profile_security/profile_action', 'frontEnd\SettingController@profileAction')->name('setting.profile.deactivation');
        Route::get('transations', 'frontEnd\SettingController@transationHistory')->name('trx.setting.show');
        Route::get('card_update', 'frontEnd\SettingController@cardInsert')->name('card.insert');
        Route::post('card_update', 'frontEnd\SettingController@cardUpdate')->name('card.update');
        Route::post('goto_free_membership', 'frontEnd\SettingController@updateMembership')->name('go.free');
        // Setting

        //Image Crop
        // Route::get('image-crop', 'frontEnd\ImageController@imageCrop');

        Route::post('image-crop', 'frontEnd\ImageController@imageCropPost')->name('image-crop');
        Route::post('blogimage-crop', 'frontEnd\ImageController@blogImageCropPost')->name('blogimage-crop');
        Route::post('eventimage-crop', 'frontEnd\ImageController@eventImageCropPost')->name('eventimage-crop');
        Route::post('groupimage-crop', 'frontEnd\ImageController@groupImageCropPost')->name('groupimage-crop');

        Route::put('user/{user}/online', 'frontEnd\realTime\UserOnlineController');
        Route::put('authuser/online', 'frontEnd\realTime\UserOnlineController@authOnline');
        Route::put('user/{user}/offline', 'frontEnd\realTime\UserOfflineController');
        //Image Crop

        //coupon
        Route::post('portal_coupon', 'frontEnd\PortalController@promoCodeStore')->name('portal_coupon.store');
        Route::delete('portal_coupon', 'frontEnd\PortalController@promoCodeDestroy')->name('portal_coupon.destroy');
        //coupon

    });
    //Frontend
}

Route::post('/image/process', 'frontEnd\ImageController@imageprocess')->name('image.process');

// Admin Panel
Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/chart', 'AdminController@incomechart')->name('admin.dashboard.chart');
    Route::get('/settings', 'AdminController@settings')->name('admin.settings');
    Route::post('/settings/update', 'AdminController@settings_update')->name('admin.settings.update');
    // Users
    Route::resource('users', 'UserController');
    Route::get('userShowModal/{id}', 'UserController@userShowModal')->name('admin.user.show');
    Route::get('userEditModal/{id}', 'UserController@userEditModal')->name('admin.user.edit');
    Route::post('user/update', 'UserController@update')->name('admin.user.update');
    Route::post('user/deactive/{id}', 'UserController@deactive')->name('admin.user.deactive');

    // region
    Route::get('region', 'Backend\RegionController@index')->name('region.index');
    Route::post('region/store', 'Backend\RegionController@store')->name('region.store');
    Route::get('region/edit/{id}', 'Backend\RegionController@edit')->name('region.edit');
    Route::post('region', 'Backend\RegionController@update')->name('region.update');
    Route::post('region/delete/{id}', 'Backend\RegionController@destroy')->name('region.destroy');

    // customers / members
    Route::get('customers', 'Backend\CustomerController@index')->name('customers.list');

    // chatroom
    Route::get('chatroom', 'Backend\ChatRoomDetailsController@index')->name('chatroom.index');
    Route::post('chatroom/store', 'Backend\ChatRoomDetailsController@store')->name('chatroom.store');
    Route::get('chatroom/edit/{id}', 'Backend\ChatRoomDetailsController@edit')->name('chatroom.edit');
    Route::post('chatroom/update', 'Backend\ChatRoomDetailsController@update')->name('chatroom.update');
    Route::post('chatroom/delete/{id}', 'Backend\ChatRoomDetailsController@destroy')->name('chatroom.destroy');

    // promocode
    Route::get('/promocode', 'Backend\PromoCodeController@index')->name('promocode.index');
    Route::post('/store', 'Backend\PromoCodeController@store')->name('promocode.store');
    Route::post('/uploadFile', 'Backend\PromoCodeController@uploadFile');
    Route::post('custom', 'Backend\PromoCodeController@customCode')->name('custom');
    Route::post('exportCSV', 'Backend\PromoCodeController@exportCSV');
    Route::post('exportXL', 'Backend\PromoCodeController@exportXL');

    // Announcement
    Route::get('announcement', 'Backend\AnnouncementController@index')->name('announcement.index');
    Route::post('announcement/store', 'Backend\AnnouncementController@store')->name('announcement.store');
    Route::get('announcement/edit/{id}', 'Backend\AnnouncementController@edit')->name('announcement.edit');
    Route::post('announcement/update/{id}', 'Backend\AnnouncementController@update')->name('announcement.update');
    Route::post('announcement/delete/{id}', 'Backend\AnnouncementController@destroy')->name('announcement.destroy');
    Route::get('announcements', 'Backend\AnnouncementController@announcementList')->name('announcement.list');

    // Reported status
    Route::get('report', 'Backend\StatusController@reportedStatusesList')->name('reported-status.index');
});
// Admin Panel
