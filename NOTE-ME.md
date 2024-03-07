1. Install wsl2 + Ubuntu
   Run Powershell in Administrator.
   Run wsl --install -d Ubuntu

2. Create project directory inside Linux Ubuntu
   Run mkdir www = create www folder
   Run cd www = go into the www direc

3. Integrate wsl to ubuntu OS into docker desktop
   Open docker desktop.
   Setting->resources->wsl integration, ubuntu + apply&restart.
   Run docker in Ubuntu cmd line, all docker cmd line will display.

4. Open Linux File System using Windows Explorer
   Run [explorer.exe .] = '.' is indicate current folder

5. Create new folder for laravel project
   Run mkdir laravel10.
   Run cd laravel10.

6. Create new Laravel project
   Make sure to open Ubuntu cmd line.
   Run cmd line given in Laravel Doc using Linux => curl -s https://laravel.build/[project-name] | bash

7. Open project in VScode
   Run [code .] when in root folder.

8. Run project
   Run ./vendor/bin/sail up
   Open http://localhost in browser.

## To Run Project + Interact with the containers running Laravel application and its dependencies.

Run Docker Desktop
Run ./vendor/bin/sail up = start laravel server use of Laravel Sail
New tab run ./vendor/bin/sail bash
New Bash tab run npm run dev = for Laravel Breeze
= opens a bash shell within the Sail Docker containers.
= directly interact with the containers running your Laravel application and its dependencies.
= often used for tasks like running artisan commands, executing PHP scripts, or interacting with the database through tools like mysql or sqlite.

## Install & use MySQL WorkBench

## http://localhost:8025 -port use by mailpit can be used for forgot password and etc.

### Credential Exist

<!-- Admins -->

'email' => 'admin@example.com',
'name' => 'Admin',
'password' => bcrypt('admin123')

'email' => 'tom@example.com',
'name' => 'Tom',
'password' => bcrypt('password')

'email' => 'john@example.com',
'name' => 'John',
'password' => bcrypt('password')

<!-- End of Admins -->

'email' => 'zaim@example.com',
'name' => 'zaim',
'password' => bcrypt('password')

'email' => 'hariri@example.com',
'name' => 'hariri',
'password' => bcrypt('password')

### Route Exist & not properly link with any button/nav yet
Login with admin user, go-to http://localhost/admin/login
http://localhost/dashboard
http://localhost/admin

### Functionality Exist
Admin =
admin-panel = create categories, posts, text-widgets, manage contents, ...
Normal = register, login, still not defined other func

### The use of /\*_ @var \App\Models\User $user _/
#### is important because when we want to search the usage of any model-class by Find-References(VsCode right-click), it can detect it.
#### use it when auto suggestion do not appear whenever you want to use the method from that class.

### User created from filament admin will be an admin-user.

### NOTES

#### Read the comment in upvoteDownvote() method.

### THERE IS SOMETHING DIFFERENT IN post_view MIGRATION FILE then in video, i use the github style code.

#### column field in create_comments_table BUT I DONT USE THE YOUTUBE VIDEO ONE, I FOUND COMMENT UNDER YOUTUBE VIDEO PART 3, I USE COLUMN FIELD FROM THE COMMENT SECTION, THERE IS ONE EXTRA COLUMN ADDED THERE.

#### to DEBUG DATA PASS in *.BLADE, USE <PRE></PRE>, example in resources/views/livewire/comments.blade.php.

#### the wire:key in resources/views/livewire/comments.blade.php, i slightly change it to use just like how livewire documentation prefer BUT IF IN FUTURE THERE PROB, CHANGE TO YOUTUBE THAT I COMMENT IN THAT FILE.

#### because of livewire v3, my reset textarea field in comment-create.blade + CommentCreate.php not working unless i comment-out code in resources/js/app.js file.

#### change sidebar aside tag style class so it hidden in small screen.

#### <!-- <livewire:comment-item :comment="$comment" wire:key="{{ $comment->id }}-{{ $comment->comments->count() }}" /> --> the key has to be like that to make sure comments can be display more than one + can be auto display after new comment create/delete/edit/reply-add, edit, delete.

### ERROR
1. THE VIEWS, UPVOTES, DOWNVOTES STILL ERROR. DOES NOT LOOK LIKE THE YOUTUBE + SHOULD HAVE RUN THE COMMAND LINE WITH "--resource=PostResource" BECAUSE NOW DASHBOARD GOT ERROR.
#### When Zura created the custom widgets, he gave the command "php artisan make:filament-widget PostOverview" without specifying the resource with "--resource=PostResource". That is the reason these widgets are shown in dashboard as well. If you want the widgets to be shown only in view post page you should give "php artisan make:filament-widget PostOverview --resource=PostResource" command.

2. Update the top@topic nav to properly render in mobile screen. But Username + profile + logout not yet. ---i think solve, good enough

3. Still Problem About Us content out-of-boundary. ---solve after install breeze

4. But if current user view one single post/article then refresh their browser, the data also got save many time.

5. Comment do not clear after submitting. ---solve after commenting alpinejs related code in js/app.js

6. The comment can go more than second level (comment-reply-reply...) but the second reply delete will be problem, not autorefresh/auto not display after delete.

### CHALLENGE
1. As youtube suggestion, generate random token & save this in user\'s cookie and give this random token associated a lifetime like one hour and you will assume that all views the specific user will make on this post/article in one hour will be considered as one view.
2. Implement soft delete on post, categories and most important comment exm: someone delete a comment and someone blaming someone else you can check in the DB that the actual comment was presented there.

<!-- Project Related -->

1. Want to Run all artisan cmd inside Main Laravel Container
   In second terminal VSC, run ./vendor/bin/sail bash. => will bring to sail@...:/var/www/html$
   Can check php version which is the latest, run php -v.
   Can check all files & folder inside this container, run ls -la.

#### This $html$ is mapped to the current root directory of project

2. Install Filamentphp
   In second terminal,
   Run this first -> composer require filament/filament:"^3.2" -W
   Run this after that finish -> php artisan filament:install --panels, will be ask What is the ID? = admin.
   Open localhost/admin ->redirect to localhost/admin/login.

3. Create the Database by migrate
   Run php artisan migrate.

4. Create a user (using filament given cmd)
   Run php artisan make:filament-user.
   email: zaim@example.com, password: password, name: zaim

5. Create Storage Link to upload images
   Run php artisan storage:link.

6. Create two main Models + Migration & one junction model+migration files
   php artisan make:model Category -m
   php artisan make:model Post -m
   php artisan make:model CategoryPost -m

#### One Category can have multiple Post, while one Post can belongs to multiple Category.

    Add code in migrations files.
    For category_users migration file, change the name into singular form as Laravel Doc recommended => category_user in up() method.
    Run php artisan migrate.
    Add $fillable field + method in Model (Post & Category) file.

7.  Creating a resource (using filament given cmd)
    Run php artisan make:filament-resource Category --simple --generate ==> generate CategoryResource.php
    Run php artisan make:filament-resource Post --view --generate ==> generate PostResource.php
    Add actions of DeleteAction in PostResource.php.
    In website also have been created the categories and posts tab in side navbar.

8.  Implement Slug Generation
    Add ->reactive()->afterStateUpdated() in form schema for title in CategoryResource.php.

    #### But got error because the first arg in afterStateUpdated is sing Closure. So we change to ->debounce(700)->afterStateUpdated(function ($state, $set) {$set('slug', Str::slug($state));}),

    Add the same things in PostResource.php.

    #### This things make 'slug' auto generated based on title input.

9.  Adjust Form Layouts and Table Columns
    Delete slug + created_at in table CategoryResource.php. Only title + updated_at needed.
    Delete also ->sortable()->toggleable(isToggledHiddenByDefault: true) that connect to updated_at column, generated by filament.

Move the 'CategoriesResource' + 'PostResource' nav into sub-categories of Content by adding protected static ?string $navigationGroup = 'Content';.

Change the 'PostResource' icon, can use any heroicons.com, just change the name in protected static ?string $navigationIcon = 'heroicon-o-(here)';

Now change the PostResource Forms, in video they wrap the generated forms with Forms\Components\Card::make()->schema([]) but For Me, it says Card deprecated use Section.
Then, inside Section we add Forms\Components\grid::make(2)->schema([]), where inside this schema we put title + slug form. So they will display side-by-side.

Change Forms\Components\TextInput::make('thumbnail')->maxLength(2048) into Forms\Components\FileUpload::make('thumbnail').

Change in Forms\Components\Select::make('user_id')->relationship('user', 'name')->required() to Forms\Components\Select::make('category_id')->multiple()->relationship('categories', 'title')->required().

#### Create a real category (JavaScript, PHP, Laravel). Now in Post, if we search in categories field, all categories available will show-up.

#### Change the layout form for PostResource to make thumbnail and category input in upper-right side.

Wrap the form in diff-Section with ->colmnSpan(8/4).

#### Now, we need to set the user(user_id) when the record/post is about to created. Checked Creating records in Fillament Docs.

Copy+paste code from Docs into CreatePost.php.
Create a new test Post.
Update the table columns for displaying created post in PostResource.php.

Change the published_at required to not required BUT because it will cause error when we want to roll-back after delete the ->required(), now we have to check GUI DB.

#### Install any MySQL client app available. I choose MySQL Workbench 64bits.

#### Open it after installation, connection: @localhost, hostname: localhost, username: sail, pass: password.

Check laravel-10-blog db->migration table, click on table-like icon with letric -> display all migration file been run.
To Solve :-
Manually delete/drop category_post table in Workbench.
Run php artisan migrate:rollback --step=1. ==> this time succeed.
Run php artisan migrate.

### JUST-NOTE: Here i do like videos bt when run php artisan migrate, it only recreate category_posts_table which diff with video which it also create again posts_table. So, i rollback --step=2 + migrate back & it recreated categories_table+category_posts_table+posts_table which i need to recreate new category in website.

<!-- ##### ##### -->

#### IMPORTANT : The Idea here is, when we just create a post we still don't want to publish it yet so that's why we make published_at nullable.

<!-- ##### ##### -->

## The Blog-website sometime got dark because of my laptop themes.

10. Add Blog Template into Website (use Templates from Tailwind Awesome of Tailwind Blog Template)
    Change the frontend/home-page.
    Go to https://www.tailwindawesome.com/resources/tailwind-blog-template/demo.
    Click Get Template -> blog.php -> Copy all code.

In vsc, we create artisan components first.
Run php artisan make:component AppLayout.
Inside just created AppLayout.php change the file name in render() to layouts.app.
Now in resource/views/components, the app-layout.blade.php has to be rename to resource/views/layouts/app.blade.php.
Paste all code before into app.blade.
Inside those code in app.blade, Cut the code that have <!-- Posts Section --> and change with <!--{{$slot}}-->.

Before we paste Posts Section into welcome.blade,made some changes first in app.blade.
Copy html lang=... from welcome.blade paste into app.blade.
Paste Posts Section code into welcome.blade. Wrap it into x-app-layout tag.

### Rename Welcome.blade into Home.blade.

Change the route in web.php from welcome to home.

11. Render Posts From the Database 1 + 2
    Run php artisan make:controller PostController --resource --model=Post to create PostController resource controller.
    Add view('home') in index() method in PostController + update route in web.php to PostController.
    Update the index() method so it can send 'posts' variable to home.blade page.

#### Create other component to render the blog-posts while using home.blade layouts.

Run php artisan make:component PostItem --view to create post-item.blade.
Copy+paste the article from home.blade into post-item.blade.
In home.blade we loops the 'posts' variable given by index() PostController and pass into x-post-item tags layout.
In post-item.blade, display the value of 'posts' variable saved.

Add shortBody() method in Post Model to be used in post-item.blade.
Add getFormattedDate() method in Post Model for better published_at display, but it has to be datetime instance of carbon.
Create a $casts for published_at to be datetime in Post Model.
Add /storage/ in src for thumbnail.

12. Implement Pagination 1

#### Lets start to create fake data for more posts so can use pagination better.

Run php artisan make:factory PostFactory to create PostFactory.php.
Initialize fake data in PostFactory + initialize how many fake data to be created in DatabaseSeeder.php.
Run php artisan db:seed. ==> FakeData Created.
Add getThumbnail() method in Post Model for displaying thumbnail in post-item.blade layout.

#### Start the pagination

In PostController, set pagination to 5.
Add <!-- {{ $posts->links() }} -->.

#### To style the pagination as given by template, we go to https://laravel.com/docs/10.x/pagination#customizing-the-pagination-view.

This create a few things under direc resources/views/vendor/pagination BUT we will use the tailwind.blade.php.
Copy+paste the class of pagination from home.blade into tailwind.blade.

### THIS IS HARD TO NOTE AS THE CODE IN TAILWIND.BLADE IS A LOT, IT GOT MOBILE PAGINATION TOO. IT JUST WE COPY CLASS FROM PAGINATION IN HOME.BLADE INTO TAILWIND + DELETE TAILWIND UNNEEDED CODE.

13. Create Text Widgets (adjustable header text + sidebar content like about us)
    Clean-up app.blade by deleting any unneeded part.

Run
php artisan make:model TextWidget -m to create TextWidget Model + create_text_widgets migration file.
Add table column in create_text_widgets migration file.

#### One of column is 'key' unique which the idea is it will be universal-table for savings some text contents for our website like About Us section and the key will be about us and based on that we can select the data from Db and output in certain places in website.

Run php artisan migrate.
Define helper method in TextWidget Model getTitle & getContent.
Create filament resource for TextWidget.
Run php artisan make:filament-resource TextWidgetResource --view --generate.
Update the code in TextWidgetResource.php + CreateTextWidget + EditTextWidget.
Delete all related to ViewTextWidget as we do not use it.

#### To delete a View button in Edit page, go EditTextWidget.php, look at return[] will have related things to View. Delete that to remove View button.

Adjust the sidebar that primarily in app.blade and move out to home.blade but put into separate component.
Run php artisan make:component Sidebar.
Add + update the sidebar code from home.blade into sidebar.blade.
Use x-sidebar tag in home.blade.

Create text widget for header too.
Display the text widget in app.blade with <!-- {{ \App\Models\TextWidget::getTitle('header') }} -->.

14. Post Inner Page
    Add new route to post show in web.php.
    In show() method PostController, add new code.
    Create post folder/view.blade file.
    Copy+paste code from post.php of blog-template into view.blade + delete all except Post Section.
    Update the code to display data from DB given by PostController show() method with '$post' variable.

Create the previous-next button functionality in PostController show() method, the btn exist in post/view.blade.

### Means of query for next-button

<!-- $next = Post::query()

The Post must be status=active.
->where('active', true)

The post published date must be lessThan equal to now/today which means the post has been Published.
->whereDate('published_at', '<=', Carbon::now())

The post publish date must lessThan the publish date of the currentPost
->whereDate('published_at', '<', $post->published_at)

Order by latest-to-oldest(desc in date will give the latest one first)
->orderBy('published_at', 'desc')

Only one result needed
->limit(1)
->first(); -->

15. Post by Category

#### Let's implement outputting categories in the sidebar + main nav(top 5 categories basedOn number of posts).

### Sidebar of categories

Add x-sidebar tag in post/view.blade.
Display all categories in sidebar.blade.
Create + pass $categories variable to sidebar.blade in View/Component/Sidebar.

### Main Nav of categories + home + about-us nav-btn

Copy+paste code from View/Component/Sidebar into View/Component/AppLayout.
Create the main nav in app.blade by using $categories given from View/Component/AppLayout.

### Activate all link route by categories

Create byCategory() method in PostController.
Declare route to byCategory in web.php.
Use by-category route in category link in app.blade & sidebar.blade.

Delete all /PostResource/Pages/ViewPost related from PostResource.

16. About Us Page
    Create new controller for about-us, run php artisan make:controller SiteController.
    Declare the route in web.php, do Remember route positioning is important.
    Use the about-us route in link in app.blade & sidebar.blade.
    Add code in SideController.
    Create views/about.blade.php & add code in there.

17. SEO Meta Fields
    Create a few new migration file = meta-title & meta-desc.
    Run php artisan make:migration add_meta_fields_to_posts_table.
    Add $table column into that migration file.
    Run php artisan migrate.
    Add $fillable of those $table column=meta in Post Model.
    Add new column in $form PostResource.php for those meta.
    Use the meta in app.blade title tag & meta tag in html-head.
    Declare the meta as parameter in AppLayout.php.
    Implement meta-title, meta-description in layout, app, home, about, post/index(post-by-category-based-page).

18. Final Touches on the Website - Part 1
    Add route to home-page to the blog title.
    Restyling the categories inline when category for a post more than one.

#### Dir + file name + reason

post/index(post-by-category-based-page)
post/view(single-post-page)
post-item(post-in-homepage)
home(postsection-layout-of-homepage)
app(baselayout)

###### Still Problem About Us content out-of-boundary. ---solve after install breeze

## DONE PART 1


19. Signup & Login (use Laravel Breeze)
    Using Laravel Doc as ref, run composer require laravel/breeze --dev.
    Run php artisan breeze:install.
    Will be ask a few Q, stack=0, dark=no, Pest test=no. Then will be Error as expected.
    To solve, we copy+paste home.blade. Rename it to welcome.blade.

### Make sure to backup (git) everything before reinstall Laravel Breeze, as it modify views.

Run installation again.
Succeed then

#### Run npm run dev,

Go-to http://localhost, there will be error on $posts.

### A lot changes now.

Open web.php where Breeze had adjust everything in it.
Copy+paste code from githb given web.php into or web.php. (JUST INSTALLED EXTENSION FOR GIT CHANGES)
Do the same for AppLayout.php + app.blade.php.

### For app.blade

Cdn alpine from previous one used will be deleted & change to newest @vite() script generate by breeze.
Delete tailwind style too but need to add server: {} in vite.config.js.

### Breeze create auth related pages, but we will adjust it style

guest.blade as base layout for all auth file, we wrap it around x-app-layout too.

After login, we redirect to /dashboard which we don't have yet and not need yet.
So, update in RouteServiceProvider to /home.

Create Login Register button on main-nav in app.blade.
Update in RouteServiceProvider route after login to /.

### Update more in app.blade.

We take Settings Dropdown from navigation.blade into app.blade.
We update the styling on app.blade.
Cut + paste the style .font-family-karla & pre from app.blade. into resources/css/app.css.

Delete welcome.blade.

### User Auth & Restriction

In User.php add implements MustVerifyEmail. ==> This will give extra security which even user who just created account is authorize BUT they are not VERIFIED yet.

#### Because of this, if we open http://localhost:8025 -port use by mailpit, there is an email send by our blog to user who just created-account.

New user however can access /admin panel page that should not.

20. Role & Permissions (Permission package from Spatie)

### Use Permission package from Spatie

Run composer require spatie/laravel-permission.
Run php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider".
Run php artisan optimize:clear.
Run php artisan migrate.

In User.php add HasRoles from Spatie\Permission/.. .
Create Admin-User, creating admin role.
Update code in DatabaseSeeder.php.
Run php artisan db:seed.

### Now in Database:

### User-table will have admin account detail.

### Role-table will have admin role registered.

### Model_Has_Role-table will have role_id, model_type, model_id that justify/combination of Role-table with User-table.

Update User.php by add FilamentUser in class User.
Need to func canAccessPanel() but maybe because of Filament v3, there is extra parameter compare to youtube-video+github(v2).
Func canAccessPanel() for rule of who can access '/admin' panel.

Create UserResource.php (based on PostResource as the youtube told) by run php artisan make:filament-resource User --view --generate.
Update the UserResource to have roles display+add, so add code in CreateUser.php.

In CreateUser, create handleRecordCreation(). Important to add use ..... field.
Update UserRescource, LOOKS AT FORM PASSWORD FIELD we put ->hiddenOn('edit').

#### Now problem email_verified_at is not required as we do not want it to be required but if user not verified yet, they cannot login. So, let make it auto enter the value to that input(we do not display it in the form).

Add mutate... method from CreatePost into CreateUser.
Add email_verified_at in $fillable in User Model.
Add encryption for password (but video create it in mutate.. method in CreateUser not User Model yet).

### Update the top@topic nav to properly render in mobile screen. But Username + profile + logout not yet.

21. Likes & Dislikes (upvote & downvote)(Use Laravel LiveWire)
    Add @livewireStyles @livewireScripts in app.blade.
    Create a component(LiveWire), run php artisan make:livewire UpvoteDownvote.

    #### This create app/Livewire/UpvoteDownvote.php.

    In post/view.blade, use
    <!-- <livewire:upvote-downvote /> --> of upvote-downvote.blade LiveWire component.

    #### Lets focus on Database to save upvote-downvote.

    Create new model and migration for UpvoteDownvote, run php artisan make:model UpvoteDownvote -m.

    #### This create app/Models/UpvoteDownvote.php & migration file create_upvote_downvotes_table.php.

    Add column field in migration file.
    <!--
    This field true if user click upvote, false if ser click downvote
    $table->boolean('is_upvote');
    -->

    Run php artisan migrate.
    Add $fillable in app/Models/UpvoteDownvote.php.
    Add code in app/Livewire/UpvoteDownvote.php and upvote-downvote.blade.
    In upvote-downvote.blade the main div I add mt-8 as the up/downvote icon is too near to top contain(video not se this).
    Add method mount() and upvoteDownvote() into app/Livewire/UpvoteDownvote.php.
    Create the $upvotes & $downvotes in render() method and pass it to upvote-downvote.blade.
    In upvoteDownvote() method we check if user has login + if user has verified email(this one Laravel Breeze has generated to us, can check the middleware in route/auth.php, find 'verification.notice').

    #### Read the comment in upvoteDownvote() method.

22. Count Post Views

#### whenever user open a post/article, we save that view and also userId(maybe ip address and user agent so that we have information from which location user checking our posts and from which browsers).

Run php artisan make:model PostView -m.
Add column field in create_post_views_table.php.

<!--
For this column, we make nullable() because maybe unAuthorize user can view our post/article too
$table->foreignId('user_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
 -->

Add $fillable field in PostView Model.
Run php artisan migrate

#### THERE IS SOMETHING DIFFERENT IN post_view MIGRATION FILE then in video, i use the github style code.

Add code related to PostView in PostController show() method, add Request parameter + add

<!-- 
$user = $request->user();
PostView::create([
  'ip_address' => $request->ip(),
  'user_agent' => $request->userAgent(),
  'post_id' => $post->id,
  'user_id' => $user?->id
]);
 -->.

#### But if current user view one single post/article then refresh their browser, the data also got save many time.

## CHALLENGE

#### As youtube suggestion, generate random token & save this in user\'s cookie and give this random token associated a lifetime like one hour and you will assume that all views the specific user will make on this post/article in one hour will be considered as one view.

23. Custom Widgets in Admin

### Diff from youtube filament v3 is here(admin panel change to panel builder), https://filamentphp.com/docs/3.x/panels/resources/widgets.

### HERE I Have To Recreate PostResource/ViewPost.php.

Install resource widget, run php artisan make:filament-widget PostOverview.
This create PostOverview.php + post-overview.blade.
Recreate the ViewPost.php file in PostResource folder.
Copy+paste getHeaderWidgets() from vendor/filament/filament/src/Pages/Page.php, add into PostResource/ViewPost.php.
Update the return array in getHeaderWidgets() to PostOverview::class.

#### Now we can see the text from post-overview.blade being display in container in ViewPost page.

Adjust the size of container by adding $columnSpan in PostOverview.php.
Add function getViewData() into PostOverview.php (from vendor/filament/widgets/src/Widget.php or ctrl+click on extends Widget in PostOverview.php).
Add return data in that method.

## THE VIEWS, UPVOTES, DOWNVOTES STILL ERROR. DOES NOT LOOK LIKE THE YOUTUBE + SHOULD HAVE RUN THE COMMAND LINE WITH "--resource=PostResource" BECAUSE NOW DASHBOARD GOT ERROR.

#### When Zura created the custom widgets, he gave the command "php artisan make:filament-widget PostOverview" without specifying the resource with "--resource=PostResource". That is the reason these widgets are shown in dashboard as well. If you want the widgets to be shown only in view post page you should give "php artisan make:filament-widget PostOverview --resource=PostResource" command.

24. Search in Posts and Categories
    Add ->searchable() in table in PostResource & CategoryResource, make ([..., ...]) if want to serachable more than one field exm: PostResource title field.
    Add ->sortable() too.

25. Add Estimated Read Time
    In Post model, create the humanReadTime() method and use it in post/view.blade & post-item.blade..
    The read time/minutes created by estimating 200 words per minute. divide the count of words by 200 we got the minutes.

26. Home Page - Design
27. Home Page - Popular Posts
    Just update PostController method index()/home(), Post Model shortBody() add parameter, Category Model add publishedPosts() method, and add + update code in home.blade.

28. Home Page - Recommended Articles
    Have to re-run php artisan make:component PostItem, so that i can get the class file in app/View/Components.
    Before this just run php artisan make:component PostItem --view.

#### I should see 3 recommended post with laravel tag because i have upvoted one post with laravel tag but the upvote one will not included here.

#### Check if there is any active post for this particular category
<!-- 
Category::query()
->whereHas('posts', function ($query) {
$query
->where('active', '=', 1)
->whereDate('published_at', '<', Carbon::now());
}) 
-->

## DONE PART 2

29. Reading and Writing Comments
Run php artisan make:model Comment -m, create Comment model + migration.

Add column field in create_comments_table 
#### BUT I DONT USE THE YOUTUBE VIDEO ONE, I FOUND COMMENT UNDER YOUTUBE VIDEO PART 3, I USE COLUMN FIELD FROM THE COMMENT SECTION, THERE IS ONE EXTRA COLUMN ADDED THERE.
Add $fillable in Comment Model.
Run php artisan migrate.

Run php artisan make:livewire Comments, create livewire component app/Livewire/Comments.php & resources/views/livewire/comments.blade.php.
Run php artisan make:livewire CommentItem, create livewire component app/Livewire/CommentItem.php & resources/views/livewire/comment-item.blade.php.
Run php artisan make:livewire CommentCreate, create livewire component app/Livewire/CommentCreate.php & resources/views/livewire/comment-create.blade.php.

Run npm install @tailwindcss/forms.
Visit tailwindui.com/components find the contact form UI and copy the style of form input and button.
Paste in comment-create.blade.

Add code in app/Livewire/Comments.php, CommentCreate.php, CommentItem.php, also in resources/views/livewire/comments.blade, comment-create.blade, and comment-item.blade.


#### For the function of add new comment + immediately render the comment without need to refresh browser, Because i use Livewire V3, youtube style code which use emitUp/emit - $listeners cannot be used anymore. So, i use dispatch() - #[On(...)].
#### for this function, other than above, other is same with video. related file for it are comment-create.blade -> CommenCreate -> Comments -> comments.blade.

30. Deleting Comments

31. Editing Comments
Here youtube video run php artisan make:migration add_parent_id_on_comments_table.
#### But because i already did when first create the comment table, i do not do this anymore here.

32. Replying comments
#### This project only allow two level of comments. parent - child. do not have any grandchildren level.

#### Everything just the same with video except how to emit which used dispatch, and listening to the emit which use #on.

1. For create comment -> comment-create call createComment() component on submit button click event and do the creation + dispatch even 'commentCreated' from createComment() method in CommentCreate component. Comments component listen to that even #[On('commentCreated')].

2. For delete comment -> comment-item call deleteComment() method on delete button click event and do the deletion + dispatch even 'commentDeleted' from deleteComment() method in CommentItem component. Comments component listen to that even #[On('commentDeleted')].

3. For cancel edit comment -> comment-item call startCommentEdit() method on edit button click event, startCommentEdit() method from CommentItem component open the edit input field which a create-comment field actually, But if click on cancel button, cancel button will dispatch == $dispatch('cancelEditing') from create-comment. CommentItem component listen to that even #[On('cancelEditing')].

4. For edit+update comment -> comment-item call startCommentEdit() method on edit button click event, startCommentEdit() method from CommentItem component open the edit input field which a create-comment field actually, submit the input will go to createComment() method from Comments component just like No.1 but under edit an existing comment + dispatch even 'commentUpdated' from createComment(). CommentItem component listen to that even #[On('commentUpdated')].

5. For reply comment -> comment-item call startReply() method on reply button click event, startReply() method from CommentItem component open a new create input field which create-comment field, submit the input will go to createComment() method from Comments component just like No-1 except will bring along $parent->id. After creation, createComment() method from Comments component will dispatch event 'commentCreated'. CommentItem component listen to that even #[On('commentCreated')].
#### BUT I'M NOT SURE IF Comments component also listen to this even #[On('commentCreated')] eventhough Based On No-1. But This one create-comment coming from comment-item (reply on parent comment).

32. Finish comments

33. Global Search for posts
Add input field for search in app.blade.
Add new route for search in web.php.
Create new search() method in PostController.

DONE


Next settle the error on admin dashboard


