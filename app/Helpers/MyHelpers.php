<?php

if (!function_exists("font_awesome")) {
    function font_awesome()
    {
        $json = '{
                       "fab fa-500px":"fa-500px", "fab fa-accessible-icon":"fa-accessible-icon", "fab fa-accusoft":"fa-accusoft", "fab fa-acquisitions-incorporated":"fa-acquisitions-incorporated", "fa fa-ad":"fa-ad", "fa fa-address-book":"fa-address-book", "fa fa-address-card":"fa-address-card", "fa fa-adjust":"fa-adjust", "fab fa-adn":"fa-adn", "fab fa-adobe":"fa-adobe", "fab fa-adversal":"fa-adversal", "fab fa-affiliatetheme":"fa-affiliatetheme", "fa fa-air-freshener":"fa-air-freshener", "fab fa-airbnb":"fa-airbnb", "fab fa-algolia":"fa-algolia", "fa fa-align-center":"fa-align-center", "fa fa-align-justify":"fa-align-justify", "fa fa-align-left":"fa-align-left", "fa fa-align-right":"fa-align-right", "fab fa-alipay":"fa-alipay", "fa fa-allergies":"fa-allergies", "fab fa-amazon":"fa-amazon", "fab fa-amazon-pay":"fa-amazon-pay", "fa fa-ambulance":"fa-ambulance", "fa fa-american-sign-language-interpreting":"fa-american-sign-language-interpreting", "fab fa-amilia":"fa-amilia", "fa fa-anchor":"fa-anchor", "fab fa-android":"fa-android", "fab fa-angellist":"fa-angellist", "fa fa-angle-double-down":"fa-angle-double-down", "fa fa-angle-double-left":"fa-angle-double-left", "fa fa-angle-double-right":"fa-angle-double-right", "fa fa-angle-double-up":"fa-angle-double-up", "fa fa-angle-down":"fa-angle-down", "fa fa-angle-left":"fa-angle-left", "fa fa-angle-right":"fa-angle-right", "fa fa-angle-up":"fa-angle-up", "fa fa-angry":"fa-angry", "fab fa-angrycreative":"fa-angrycreative", "fab fa-angular":"fa-angular", "fa fa-ankh":"fa-ankh", "fab fa-app-store":"fa-app-store", "fab fa-app-store-ios":"fa-app-store-ios", "fab fa-apper":"fa-apper", "fab fa-apple":"fa-apple", "fa fa-apple-alt":"fa-apple-alt", "fab fa-apple-pay":"fa-apple-pay", "fa fa-archive":"fa-archive", "fa fa-archway":"fa-archway", "fa fa-arrow-alt-circle-down":"fa-arrow-alt-circle-down", "fa fa-arrow-alt-circle-left":"fa-arrow-alt-circle-left", "fa fa-arrow-alt-circle-right":"fa-arrow-alt-circle-right", "fa fa-arrow-alt-circle-up":"fa-arrow-alt-circle-up", "fa fa-arrow-circle-down":"fa-arrow-circle-down", "fa fa-arrow-circle-left":"fa-arrow-circle-left", "fa fa-arrow-circle-right":"fa-arrow-circle-right", "fa fa-arrow-circle-up":"fa-arrow-circle-up", "fa fa-arrow-down":"fa-arrow-down", "fa fa-arrow-left":"fa-arrow-left", "fa fa-arrow-right":"fa-arrow-right", "fa fa-arrow-up":"fa-arrow-up", "fa fa-arrows-alt":"fa-arrows-alt", "fa fa-arrows-alt-h":"fa-arrows-alt-h", "fa fa-arrows-alt-v":"fa-arrows-alt-v", "fab fa-artstation":"fa-artstation", "fa fa-assistive-listening-systems":"fa-assistive-listening-systems", "fa fa-asterisk":"fa-asterisk", "fab fa-asymmetrik":"fa-asymmetrik", "fa fa-at":"fa-at", "fa fa-atlas":"fa-atlas", "fab fa-atlassian":"fa-atlassian", "fa fa-atom":"fa-atom", "fab fa-audible":"fa-audible", "fa fa-audio-description":"fa-audio-description", "fab fa-autoprefixer":"fa-autoprefixer", "fab fa-avianex":"fa-avianex", "fab fa-aviato":"fa-aviato", "fa fa-award":"fa-award", "fab fa-aws":"fa-aws", "fa fa-baby":"fa-baby", "fa fa-baby-carriage":"fa-baby-carriage", "fa fa-backspace":"fa-backspace", "fa fa-backward":"fa-backward", "fa fa-bacon":"fa-bacon", "fa fa-balance-scale":"fa-balance-scale", "fa fa-ban":"fa-ban", "fa fa-band-aid":"fa-band-aid", "fab fa-bandcamp":"fa-bandcamp", "fa fa-barcode":"fa-barcode", "fa fa-bars":"fa-bars", "fa fa-baseball-ball":"fa-baseball-ball", "fa fa-basketball-ball":"fa-basketball-ball", "fa fa-bath":"fa-bath", "fa fa-battery-empty":"fa-battery-empty", "fa fa-battery-full":"fa-battery-full", "fa fa-battery-half":"fa-battery-half", "fa fa-battery-quarter":"fa-battery-quarter", "fa fa-battery-three-quarters":"fa-battery-three-quarters", "fab fa-battle-net":"fa-battle-net", "fa fa-bed":"fa-bed", "fa fa-beer":"fa-beer", "fab fa-behance":"fa-behance", "fab fa-behance-square":"fa-behance-square", "fa fa-bell":"fa-bell", "fa fa-bell-slash":"fa-bell-slash", "fa fa-bezier-curve":"fa-bezier-curve", "fa fa-bible":"fa-bible", "fa fa-bicycle":"fa-bicycle", "fab fa-bimobject":"fa-bimobject", "fa fa-binoculars":"fa-binoculars", "fa fa-biohazard":"fa-biohazard", "fa fa-birthday-cake":"fa-birthday-cake", "fab fa-bitbucket":"fa-bitbucket", "fab fa-bitcoin":"fa-bitcoin", "fab fa-bity":"fa-bity", "fab fa-black-tie":"fa-black-tie", "fab fa-blackberry":"fa-blackberry", "fa fa-blender":"fa-blender", "fa fa-blender-phone":"fa-blender-phone", "fa fa-blind":"fa-blind", "fa fa-blog":"fa-blog", "fab fa-blogger":"fa-blogger", "fab fa-blogger-b":"fa-blogger-b", "fab fa-bluetooth":"fa-bluetooth", "fab fa-bluetooth-b":"fa-bluetooth-b", "fa fa-bold":"fa-bold", "fa fa-bolt":"fa-bolt", "fa fa-bomb":"fa-bomb", "fa fa-bone":"fa-bone", "fa fa-bong":"fa-bong", "fa fa-book":"fa-book", "fa fa-book-dead":"fa-book-dead", "fa fa-book-medical":"fa-book-medical", "fa fa-book-open":"fa-book-open", "fa fa-book-reader":"fa-book-reader", "fa fa-bookmark":"fa-bookmark", "fa fa-bootstrap":"fa-bootstrap", "fa fa-bowling-ball":"fa-bowling-ball", "fa fa-box":"fa-box", "fa fa-box-open":"fa-box-open", "fa fa-boxes":"fa-boxes", "fa fa-braille":"fa-braille", "fa fa-brain":"fa-brain", "fa fa-bread-slice":"fa-bread-slice", "fa fa-briefcase":"fa-briefcase", "fa fa-briefcase-medical":"fa-briefcase-medical", "fa fa-broadcast-tower":"fa-broadcast-tower", "fa fa-broom":"fa-broom", "fa fa-brush":"fa-brush", "fab fa-btc":"fa-btc", "fa fa-buffer":"fa-buffer", "fa fa-bug":"fa-bug", "fa fa-building":"fa-building", "fa fa-bullhorn":"fa-bullhorn", "fa fa-bullseye":"fa-bullseye", "fa fa-burn":"fa-burn", "fab fa-buromobelexperte":"fa-buromobelexperte", "fa fa-bus":"fa-bus", "fa fa-bus-alt":"fa-bus-alt", "fa fa-business-time":"fa-business-time", "fab fa-buysellads":"fa-buysellads", "fa fa-calculator":"fa-calculator", "fa fa-calendar":"fa-calendar", "fa fa-calendar-alt":"fa-calendar-alt", "fa fa-calendar-check":"fa-calendar-check", "fa fa-calendar-day":"fa-calendar-day", "fa fa-calendar-minus":"fa-calendar-minus", "fa fa-calendar-plus":"fa-calendar-plus", "fa fa-calendar-times":"fa-calendar-times", "fa fa-calendar-week":"fa-calendar-week", "fa fa-camera":"fa-camera", "fa fa-camera-retro":"fa-camera-retro", "fa fa-campground":"fa-campground", "fa fa-canadian-maple-leaf":"fa-canadian-maple-leaf", "fa fa-candy-cane":"fa-candy-cane", "fa fa-cannabis":"fa-cannabis", "fa fa-capsules":"fa-capsules", "fa fa-car":"fa-car", "fa fa-car-alt":"fa-car-alt", "fa fa-car-battery":"fa-car-battery", "fa fa-car-crash":"fa-car-crash", "fa fa-car-side":"fa-car-side", "fa fa-caret-down":"fa-caret-down", "fa fa-caret-left":"fa-caret-left", "fa fa-caret-right":"fa-caret-right", "fa fa-caret-square-down":"fa-caret-square-down", "fa fa-caret-square-left":"fa-caret-square-left", "fa fa-caret-square-right":"fa-caret-square-right", "fa fa-caret-square-up":"fa-caret-square-up", "fa fa-caret-up":"fa-caret-up", "fa fa-carrot":"fa-carrot", "fa fa-cart-arrow-down":"fa-cart-arrow-down", "fa fa-cart-plus":"fa-cart-plus", "fa fa-cash-register":"fa-cash-register", "fa fa-cat":"fa-cat", "fab fa-cc-amazon-pay":"fa-cc-amazon-pay", "fab fa-cc-amex":"fa-cc-amex", "fab fa-cc-apple-pay":"fa-cc-apple-pay", "fab fa-cc-diners-club":"fa-cc-diners-club", "fab fa-cc-discover":"fa-cc-discover", "fab fa-cc-jcb":"fa-cc-jcb", "fab fa-cc-mastercard":"fa-cc-mastercard", "fab fa-cc-paypal":"fa-cc-paypal", "fab fa-cc-stripe":"fa-cc-stripe", "fab fa-cc-visa":"fa-cc-visa", "fab fa-centercode":"fa-centercode", "fab fa-centos":"fa-centos", "fa fa-certificate":"fa-certificate", "fa fa-chair":"fa-chair", "fa fa-chalkboard":"fa-chalkboard", "fa fa-chalkboard-teacher":"fa-chalkboard-teacher", "fa fa-charging-station":"fa-charging-station", "fa fa-chart-area":"fa-chart-area", "fa fa-chart-bar":"fa-chart-bar", "fa fa-chart-line":"fa-chart-line", "fa fa-chart-pie":"fa-chart-pie", "fa fa-check":"fa-check", "fa fa-check-circle":"fa-check-circle", "fa fa-check-double":"fa-check-double", "fa fa-check-square":"fa-check-square", "fa fa-cheese":"fa-cheese", "fa fa-chess":"fa-chess", "fa fa-chess-bishop":"fa-chess-bishop", "fa fa-chess-board":"fa-chess-board", "fa fa-chess-king":"fa-chess-king", "fa fa-chess-knight":"fa-chess-knight", "fa fa-chess-pawn":"fa-chess-pawn", "fa fa-chess-queen":"fa-chess-queen", "fa fa-chess-rook":"fa-chess-rook", "fa fa-chevron-circle-down":"fa-chevron-circle-down", "fa fa-chevron-circle-left":"fa-chevron-circle-left", "fa fa-chevron-circle-right":"fa-chevron-circle-right", "fa fa-chevron-circle-up":"fa-chevron-circle-up", "fa fa-chevron-down":"fa-chevron-down", "fa fa-chevron-left":"fa-chevron-left", "fa fa-chevron-right":"fa-chevron-right", "fa fa-chevron-up":"fa-chevron-up", "fa fa-child":"fa-child", "fab fa-chrome":"fa-chrome", "fab fa-chromecast":"fa-chromecast", "fa fa-church":"fa-church", "fa fa-circle":"fa-circle", "fa fa-circle-notch":"fa-circle-notch", "fa fa-city":"fa-city", "fa fa-clinic-medical":"fa-clinic-medical", "fa fa-clipboard":"fa-clipboard", "fa fa-clipboard-check":"fa-clipboard-check", "fa fa-clipboard-list":"fa-clipboard-list", "fa fa-clock":"fa-clock", "fa fa-clone":"fa-clone", "fa fa-closed-captioning":"fa-closed-captioning", "fa fa-cloud":"fa-cloud", "fa fa-cloud-download-alt":"fa-cloud-download-alt", "fa fa-cloud-meatball":"fa-cloud-meatball", "fa fa-cloud-moon":"fa-cloud-moon", "fa fa-cloud-moon-rain":"fa-cloud-moon-rain", "fa fa-cloud-rain":"fa-cloud-rain", "fa fa-cloud-showers-heavy":"fa-cloud-showers-heavy", "fa fa-cloud-sun":"fa-cloud-sun", "fa fa-cloud-sun-rain":"fa-cloud-sun-rain", "fa fa-cloud-upload-alt":"fa-cloud-upload-alt", "fab fa-cloudscale":"fa-cloudscale", "fab fa-cloudsmith":"fa-cloudsmith", "fab fa-cloudversify":"fa-cloudversify", "fa fa-cocktail":"fa-cocktail", "fa fa-code":"fa-code", "fa fa-code-branch":"fa-code-branch", "fab fa-codepen":"fa-codepen", "fab fa-codiepie":"fa-codiepie", "fa fa-coffee":"fa-coffee", "fa fa-cog":"fa-cog", "fa fa-cogs":"fa-cogs", "fa fa-coins":"fa-coins", "fa fa-columns":"fa-columns", "fa fa-comment":"fa-comment", "fa fa-comment-alt":"fa-comment-alt", "fa fa-comment-dollar":"fa-comment-dollar", "fa fa-comment-dots":"fa-comment-dots", "fa fa-comment-medical":"fa-comment-medical", "fa fa-comment-slash":"fa-comment-slash", "fa fa-comments":"fa-comments", "fa fa-comments-dollar":"fa-comments-dollar", "fa fa-compact-disc":"fa-compact-disc", "fa fa-compass":"fa-compass", "fa fa-compress":"fa-compress", "fa fa-compress-arrows-alt":"fa-compress-arrows-alt", "fa fa-concierge-bell":"fa-concierge-bell", "fab fa-confluence":"fa-confluence", "fab fa-connectdevelop":"fa-connectdevelop", "fab fa-contao":"fa-contao", "fa fa-cookie":"fa-cookie", "fa fa-cookie-bite":"fa-cookie-bite", "fa fa-copy":"fa-copy", "fa fa-copyright":"fa-copyright", "fa fa-couch":"fa-couch", "fab fa-cpanel":"fa-cpanel", "fab fa-creative-commons":"fa-creative-commons", "fab fa-creative-commons-by":"fa-creative-commons-by", "fab fa-creative-commons-nc":"fa-creative-commons-nc", "fab fa-creative-commons-nc-eu":"fa-creative-commons-nc-eu", "fab fa-creative-commons-nc-jp":"fa-creative-commons-nc-jp", "fab fa-creative-commons-nd":"fa-creative-commons-nd", "fab fa-creative-commons-pd":"fa-creative-commons-pd", "fab fa-creative-commons-pd-alt":"fa-creative-commons-pd-alt", "fab fa-creative-commons-remix":"fa-creative-commons-remix", "fab fa-creative-commons-sa":"fa-creative-commons-sa", "fab fa-creative-commons-sampling":"fa-creative-commons-sampling", "fab fa-creative-commons-sampling-plus":"fa-creative-commons-sampling-plus", "fab fa-creative-commons-share":"fa-creative-commons-share", "fab fa-creative-commons-zero":"fa-creative-commons-zero", "fa fa-credit-card":"fa-credit-card", "fab fa-critical-role":"fa-critical-role", "fa fa-crop":"fa-crop", "fa fa-crop-alt":"fa-crop-alt", "fa fa-cross":"fa-cross", "fa fa-crosshairs":"fa-crosshairs", "fa fa-crow":"fa-crow", "fa fa-crown":"fa-crown", "fa fa-crutch":"fa-crutch", "fab fa-css3":"fa-css3", "fab fa-css3-alt":"fa-css3-alt", "fa fa-cube":"fa-cube", "fa fa-cubes":"fa-cubes", "fa fa-cut":"fa-cut", "fab fa-cuttlefish":"fa-cuttlefish", "fab fa-d-and-d":"fa-d-and-d", "fab fa-d-and-d-beyond":"fa-d-and-d-beyond", "fab fa-dashcube":"fa-dashcube", "fa fa-database":"fa-database", "fa fa-deaf":"fa-deaf", "fab fa-delicious":"fa-delicious", "fa fa-democrat":"fa-democrat", "fab fa-deploydog":"fa-deploydog", "fab fa-deskpro":"fa-deskpro", "fa fa-desktop":"fa-desktop", "fab fa-dev":"fa-dev", "fab fa-deviantart":"fa-deviantart", "fa fa-dharmachakra":"fa-dharmachakra", "fab fa-dhl":"fa-dhl", "fa fa-diagnoses":"fa-diagnoses", "fab fa-diaspora":"fa-diaspora", "fa fa-dice":"fa-dice", "fa fa-dice-d20":"fa-dice-d20", "fa fa-dice-d6":"fa-dice-d6", "fa fa-dice-five":"fa-dice-five", "fa fa-dice-four":"fa-dice-four", "fa fa-dice-one":"fa-dice-one", "fa fa-dice-six":"fa-dice-six", "fa fa-dice-three":"fa-dice-three", "fa fa-dice-two":"fa-dice-two", "fab fa-digg":"fa-digg", "fab fa-digital-ocean":"fa-digital-ocean", "fa fa-digital-tachograph":"fa-digital-tachograph", "fa fa-directions":"fa-directions", "fab fa-discord":"fa-discord", "fab fa-discourse":"fa-discourse", "fa fa-divide":"fa-divide", "fa fa-dizzy":"fa-dizzy", "fa fa-dna":"fa-dna", "fab fa-dochub":"fa-dochub", "fab fa-docker":"fa-docker", "fa fa-dog":"fa-dog", "fa fa-dollar-sign":"fa-dollar-sign", "fa fa-dolly":"fa-dolly", "fa fa-dolly-flatbed":"fa-dolly-flatbed", "fa fa-donate":"fa-donate", "fa fa-door-closed":"fa-door-closed", "fa fa-door-open":"fa-door-open", "fa fa-dot-circle":"fa-dot-circle", "fa fa-dove":"fa-dove", "fa fa-download":"fa-download", "fab fa-draft2digital":"fa-draft2digital", "fa fa-drafting-compass":"fa-drafting-compass", "fa fa-dragon":"fa-dragon", "fa fa-draw-polygon":"fa-draw-polygon", "fab fa-dribbble":"fa-dribbble", "fab fa-dribbble-square":"fa-dribbble-square", "fab fa-dropbox":"fa-dropbox", "fa fa-drum":"fa-drum", "fa fa-drum-steelpan":"fa-drum-steelpan", "fa fa-drumstick-bite":"fa-drumstick-bite", "fab fa-drupal":"fa-drupal", "fa fa-dumbbell":"fa-dumbbell", "fa fa-dumpster":"fa-dumpster", "fa fa-dumpster-fire":"fa-dumpster-fire", "fa fa-dungeon":"fa-dungeon", "fab fa-dyalog":"fa-dyalog", "fab fa-earlybirds":"fa-earlybirds", "fab fa-ebay":"fa-ebay", "fab fa-edge":"fa-edge", "fa fa-edit":"fa-edit", "fa fa-egg":"fa-egg", "fa fa-eject":"fa-eject", "fab fa-elementor":"fa-elementor", "fa fa-ellipsis-h":"fa-ellipsis-h", "fa fa-ellipsis-v":"fa-ellipsis-v", "fab fa-ello":"fa-ello", "fab fa-ember":"fa-ember", "fab fa-empire":"fa-empire", "fa fa-envelope":"fa-envelope", "fa fa-envelope-open":"fa-envelope-open", "fa fa-envelope-open-text":"fa-envelope-open-text", "fa fa-envelope-square":"fa-envelope-square", "fab fa-envira":"fa-envira", "fa fa-equals":"fa-equals", "fa fa-eraser":"fa-eraser", "fab fa-erlang":"fa-erlang", "fab fa-ethereum":"fa-ethereum", "fa fa-ethernet":"fa-ethernet", "fab fa-etsy":"fa-etsy", "fa fa-euro-sign":"fa-euro-sign", "fab fa-evernote":"fa-evernote", "fa fa-exchange-alt":"fa-exchange-alt", "fa fa-exclamation":"fa-exclamation", "fa fa-exclamation-circle":"fa-exclamation-circle", "fa fa-exclamation-triangle":"fa-exclamation-triangle", "fa fa-expand":"fa-expand", "fa fa-expand-arrows-alt":"fa-expand-arrows-alt", "fab fa-expeditedssl":"fa-expeditedssl", "fa fa-external-link-alt":"fa-external-link-alt", "fa fa-external-link-square-alt":"fa-external-link-square-alt", "fa fa-eye":"fa-eye", "fa fa-eye-dropper":"fa-eye-dropper", "fa fa-eye-slash":"fa-eye-slash", "fab fa-facebook":"fa-facebook", "fab fa-facebook-f":"fa-facebook-f", "fab fa-facebook-messenger":"fa-facebook-messenger", "fab fa-facebook-square":"fa-facebook-square", "fab fa-fantasy-flight-games":"fa-fantasy-flight-games", "fa fa-fast-backward":"fa-fast-backward", "fa fa-fast-forward":"fa-fast-forward", "fa fa-fax":"fa-fax", "fa fa-feather":"fa-feather", "fa fa-feather-alt":"fa-feather-alt", "fab fa-fedex":"fa-fedex", "fab fa-fedora":"fa-fedora", "fa fa-female":"fa-female", "fa fa-fighter-jet":"fa-fighter-jet", "fab fa-figma":"fa-figma", "fa fa-file":"fa-file", "fa fa-file-alt":"fa-file-alt", "fa fa-file-archive":"fa-file-archive", "fa fa-file-audio":"fa-file-audio", "fa fa-file-code":"fa-file-code", "fa fa-file-contract":"fa-file-contract", "fa fa-file-csv":"fa-file-csv", "fa fa-file-download":"fa-file-download", "fa fa-file-excel":"fa-file-excel", "fa fa-file-export":"fa-file-export", "fa fa-file-image":"fa-file-image", "fa fa-file-import":"fa-file-import", "fa fa-file-invoice":"fa-file-invoice", "fa fa-file-invoice-dollar":"fa-file-invoice-dollar", "fa fa-file-medical":"fa-file-medical", "fa fa-file-medical-alt":"fa-file-medical-alt", "fa fa-file-pdf":"fa-file-pdf", "fa fa-file-powerpoint":"fa-file-powerpoint", "fa fa-file-prescription":"fa-file-prescription", "fa fa-file-signature":"fa-file-signature", "fa fa-file-upload":"fa-file-upload", "fa fa-file-video":"fa-file-video", "fa fa-file-word":"fa-file-word", "fa fa-fill":"fa-fill", "fa fa-fill-drip":"fa-fill-drip", "fa fa-film":"fa-film", "fa fa-filter":"fa-filter", "fa fa-fingerprint":"fa-fingerprint", "fa fa-fire":"fa-fire", "fa fa-fire-alt":"fa-fire-alt", "fa fa-fire-extinguisher":"fa-fire-extinguisher", "fab fa-firefox":"fa-firefox", "fa fa-first-aid":"fa-first-aid", "fab fa-first-order":"fa-first-order", "fab fa-first-order-alt":"fa-first-order-alt", "fab fa-firstdraft":"fa-firstdraft", "fa fa-fish":"fa-fish", "fa fa-fist-raised":"fa-fist-raised", "fa fa-flag":"fa-flag", "fa fa-flag-checkered":"fa-flag-checkered", "fa fa-flag-usa":"fa-flag-usa", "fa fa-flask":"fa-flask", "fab fa-flickr":"fa-flickr", "fab fa-flipboard":"fa-flipboard", "fa fa-flushed":"fa-flushed", "fab fa-fly":"fa-fly", "fa fa-folder":"fa-folder", "fa fa-folder-minus":"fa-folder-minus", "fa fa-folder-open":"fa-folder-open", "fa fa-folder-plus":"fa-folder-plus", "fa fa-font":"fa-font", "fab fa-font-awesome":"fa-font-awesome", "fab fa-font-awesome-alt":"fa-font-awesome-alt", "fab fa-font-awesome-flag":"fa-font-awesome-flag", "fab fa-fonticons":"fa-fonticons", "fab fa-fonticons-fi":"fa-fonticons-fi", "fa fa-football-ball":"fa-football-ball", "fab fa-fort-awesome":"fa-fort-awesome", "fab fa-fort-awesome-alt":"fa-fort-awesome-alt", "fab fa-forumbee":"fa-forumbee", "fa fa-forward":"fa-forward", "fab fa-foursquare":"fa-foursquare", "fab fa-free-code-camp":"fa-free-code-camp", "fab fa-freebsd":"fa-freebsd", "fa fa-frog":"fa-frog", "fa fa-frown":"fa-frown", "fa fa-frown-open":"fa-frown-open", "fab fa-fulcrum":"fa-fulcrum", "fa fa-funnel-dollar":"fa-funnel-dollar", "fa fa-futbol":"fa-futbol", "fab fa-galactic-republic":"fa-galactic-republic", "fab fa-galactic-senate":"fa-galactic-senate", "fa fa-gamepad":"fa-gamepad", "fa fa-gas-pump":"fa-gas-pump", "fa fa-gavel":"fa-gavel", "fa fa-gem":"fa-gem", "fa fa-genderless":"fa-genderless", "fab fa-get-pocket":"fa-get-pocket", "fab fa-gg":"fa-gg", "fab fa-gg-circle":"fa-gg-circle", "fa fa-ghost":"fa-ghost", "fa fa-gift":"fa-gift", "fa fa-gifts":"fa-gifts", "fab fa-git":"fa-git", "fab fa-git-square":"fa-git-square", "fab fa-github":"fa-github", "fab fa-github-alt":"fa-github-alt", "fab fa-github-square":"fa-github-square", "fab fa-gitkraken":"fa-gitkraken", "fab fa-gitlab":"fa-gitlab", "fab fa-gitter":"fa-gitter", "fa fa-glass-cheers":"fa-glass-cheers", "fa fa-glass-martini":"fa-glass-martini", "fa fa-glass-martini-alt":"fa-glass-martini-alt", "fa fa-glass-whiskey":"fa-glass-whiskey", "fa fa-glasses":"fa-glasses", "fab fa-glide":"fa-glide", "fab fa-glide-g":"fa-glide-g", "fa fa-globe":"fa-globe", "fa fa-globe-africa":"fa-globe-africa", "fa fa-globe-americas":"fa-globe-americas", "fa fa-globe-asia":"fa-globe-asia", "fa fa-globe-europe":"fa-globe-europe", "fab fa-gofore":"fa-gofore", "fa fa-golf-ball":"fa-golf-ball", "fab fa-goodreads":"fa-goodreads", "fab fa-goodreads-g":"fa-goodreads-g", "fab fa-google":"fa-google", "fab fa-google-drive":"fa-google-drive", "fab fa-google-play":"fa-google-play", "fab fa-google-plus":"fa-google-plus", "fab fa-google-plus-g":"fa-google-plus-g", "fab fa-google-plus-square":"fa-google-plus-square", "fab fa-google-wallet":"fa-google-wallet", "fa fa-gopuram":"fa-gopuram", "fa fa-graduation-cap":"fa-graduation-cap", "fab fa-gratipay":"fa-gratipay", "fab fa-grav":"fa-grav", "fa fa-greater-than":"fa-greater-than", "fa fa-greater-than-equal":"fa-greater-than-equal", "fa fa-grimace":"fa-grimace", "fa fa-grin":"fa-grin", "fa fa-grin-alt":"fa-grin-alt", "fa fa-grin-beam":"fa-grin-beam", "fa fa-grin-beam-sweat":"fa-grin-beam-sweat", "fa fa-grin-hearts":"fa-grin-hearts", "fa fa-grin-squint":"fa-grin-squint", "fa fa-grin-squint-tears":"fa-grin-squint-tears", "fa fa-grin-stars":"fa-grin-stars", "fa fa-grin-tears":"fa-grin-tears", "fa fa-grin-tongue":"fa-grin-tongue", "fa fa-grin-tongue-squint":"fa-grin-tongue-squint", "fa fa-grin-tongue-wink":"fa-grin-tongue-wink", "fa fa-grin-wink":"fa-grin-wink", "fa fa-grip-horizontal":"fa-grip-horizontal", "fa fa-grip-lines":"fa-grip-lines", "fa fa-grip-lines-vertical":"fa-grip-lines-vertical", "fa fa-grip-vertical":"fa-grip-vertical", "fab fa-gripfire":"fa-gripfire", "fab fa-grunt":"fa-grunt", "fa fa-guitar":"fa-guitar", "fab fa-gulp":"fa-gulp", "fa fa-h-square":"fa-h-square", "fab fa-hacker-news":"fa-hacker-news", "fab fa-hacker-news-square":"fa-hacker-news-square", "fab fa-hackerrank":"fa-hackerrank", "fa fa-hamburger":"fa-hamburger", "fa fa-hammer":"fa-hammer", "fa fa-hamsa":"fa-hamsa", "fa fa-hand-holding":"fa-hand-holding", "fa fa-hand-holding-heart":"fa-hand-holding-heart", "fa fa-hand-holding-usd":"fa-hand-holding-usd", "fa fa-hand-lizard":"fa-hand-lizard", "fa fa-hand-middle-finger":"fa-hand-middle-finger", "fa fa-hand-paper":"fa-hand-paper", "fa fa-hand-peace":"fa-hand-peace", "fa fa-hand-point-down":"fa-hand-point-down", "fa fa-hand-point-left":"fa-hand-point-left", "fa fa-hand-point-right":"fa-hand-point-right", "fa fa-hand-point-up":"fa-hand-point-up", "fa fa-hand-pointer":"fa-hand-pointer", "fa fa-hand-rock":"fa-hand-rock", "fa fa-hand-scissors":"fa-hand-scissors", "fa fa-hand-spock":"fa-hand-spock", "fa fa-hands":"fa-hands", "fa fa-hands-helping":"fa-hands-helping", "fa fa-handshake":"fa-handshake", "fa fa-hanukiah":"fa-hanukiah", "fa fa-hard-hat":"fa-hard-hat", "fa fa-hashtag":"fa-hashtag", "fa fa-hat-wizard":"fa-hat-wizard", "fa fa-haykal":"fa-haykal", "fa fa-hdd":"fa-hdd", "fa fa-heading":"fa-heading", "fa fa-headphones":"fa-headphones", "fa fa-headphones-alt":"fa-headphones-alt", "fa fa-headset":"fa-headset", "fa fa-heart":"fa-heart", "fa fa-heart-broken":"fa-heart-broken", "fa fa-heartbeat":"fa-heartbeat", "fa fa-helicopter":"fa-helicopter", "fa fa-highlighter":"fa-highlighter", "fa fa-hiking":"fa-hiking", "fa fa-hippo":"fa-hippo", "fab fa-hips":"fa-hips", "fab fa-hire-a-helper":"fa-hire-a-helper", "fa fa-history":"fa-history", "fa fa-hockey-puck":"fa-hockey-puck", "fa fa-holly-berry":"fa-holly-berry", "fa fa-home":"fa-home", "fab fa-hooli":"fa-hooli", "fab fa-hornbill":"fa-hornbill", "fa fa-horse":"fa-horse", "fa fa-horse-head":"fa-horse-head", "fa fa-hospital":"fa-hospital", "fa fa-hospital-alt":"fa-hospital-alt", "fa fa-hospital-symbol":"fa-hospital-symbol", "fa fa-hot-tub":"fa-hot-tub", "fa fa-hotdog":"fa-hotdog", "fa fa-hotel":"fa-hotel", "fab fa-hotjar":"fa-hotjar", "fa fa-hourglass":"fa-hourglass", "fa fa-hourglass-end":"fa-hourglass-end", "fa fa-hourglass-half":"fa-hourglass-half", "fa fa-hourglass-start":"fa-hourglass-start", "fa fa-house-damage":"fa-house-damage", "fab fa-houzz":"fa-houzz", "fa fa-hryvnia":"fa-hryvnia", "fab fa-html5":"fa-html5", "fab fa-hubspot":"fa-hubspot", "fa fa-i-cursor":"fa-i-cursor", "fa fa-ice-cream":"fa-ice-cream", "fa fa-icicles":"fa-icicles", "fa fa-id-badge":"fa-id-badge", "fa fa-id-card":"fa-id-card", "fa fa-id-card-alt":"fa-id-card-alt", "fa fa-igloo":"fa-igloo", "fa fa-image":"fa-image", "fa fa-images":"fa-images", "fab fa-imdb":"fa-imdb", "fa fa-inbox":"fa-inbox", "fa fa-indent":"fa-indent", "fa fa-industry":"fa-industry", "fa fa-infinity":"fa-infinity", "fa fa-info":"fa-info", "fa fa-info-circle":"fa-info-circle", "fab fa-instagram":"fa-instagram", "fab fa-intercom":"fa-intercom", "fab fa-internet-explorer":"fa-internet-explorer", "fab fa-invision":"fa-invision", "fab fa-ioxhost":"fa-ioxhost", "fa fa-italic":"fa-italic", "fab fa-itch-io":"fa-itch-io", "fab fa-itunes":"fa-itunes", "fab fa-itunes-note":"fa-itunes-note", "fab fa-java":"fa-java", "fa fa-jedi":"fa-jedi", "fab fa-jedi-order":"fa-jedi-order", "fab fa-jenkins":"fa-jenkins", "fab fa-jira":"fa-jira", "fab fa-joget":"fa-joget", "fa fa-joint":"fa-joint", "fab fa-joomla":"fa-joomla", "fa fa-journal-whills":"fa-journal-whills", "fab fa-js":"fa-js", "fab fa-js-square":"fa-js-square", "fab fa-jsfiddle":"fa-jsfiddle", "fa fa-kaaba":"fa-kaaba", "fab fa-kaggle":"fa-kaggle", "fa fa-key":"fa-key", "fab fa-keybase":"fa-keybase", "fa fa-keyboard":"fa-keyboard", "fab fa-keycdn":"fa-keycdn", "fa fa-khanda":"fa-khanda", "fab fa-kickstarter":"fa-kickstarter", "fab fa-kickstarter-k":"fa-kickstarter-k", "fa fa-kiss":"fa-kiss", "fa fa-kiss-beam":"fa-kiss-beam", "fa fa-kiss-wink-heart":"fa-kiss-wink-heart", "fa fa-kiwi-bird":"fa-kiwi-bird", "fab fa-korvue":"fa-korvue", "fa fa-landmark":"fa-landmark", "fa fa-language":"fa-language", "fa fa-laptop":"fa-laptop", "fa fa-laptop-code":"fa-laptop-code", "fa fa-laptop-medical":"fa-laptop-medical", "fab fa-laravel":"fa-laravel", "fab fa-lastfm":"fa-lastfm", "fab fa-lastfm-square":"fa-lastfm-square", "fa fa-laugh":"fa-laugh", "fa fa-laugh-beam":"fa-laugh-beam", "fa fa-laugh-squint":"fa-laugh-squint", "fa fa-laugh-wink":"fa-laugh-wink", "fa fa-layer-group":"fa-layer-group", "fa fa-leaf":"fa-leaf", "fab fa-leanpub":"fa-leanpub", "fa fa-lemon":"fa-lemon", "fab fa-less":"fa-less", "fa fa-less-than":"fa-less-than", "fa fa-less-than-equal":"fa-less-than-equal", "fa fa-level-down-alt":"fa-level-down-alt", "fa fa-level-up-alt":"fa-level-up-alt", "fa fa-life-ring":"fa-life-ring", "fa fa-lightbulb":"fa-lightbulb", "fab fa-line":"fa-line", "fa fa-link":"fa-link", "fab fa-linkedin":"fa-linkedin", "fab fa-linkedin-in":"fa-linkedin-in", "fab fa-linode":"fa-linode", "fab fa-linux":"fa-linux", "fa fa-lira-sign":"fa-lira-sign", "fa fa-list":"fa-list", "fa fa-list-alt":"fa-list-alt", "fa fa-list-ol":"fa-list-ol", "fa fa-list-ul":"fa-list-ul", "fa fa-location-arrow":"fa-location-arrow", "fa fa-lock":"fa-lock", "fa fa-lock-open":"fa-lock-open", "fa fa-long-arrow-alt-down":"fa-long-arrow-alt-down", "fa fa-long-arrow-alt-left":"fa-long-arrow-alt-left", "fa fa-long-arrow-alt-right":"fa-long-arrow-alt-right", "fa fa-long-arrow-alt-up":"fa-long-arrow-alt-up", "fa fa-low-vision":"fa-low-vision", "fa fa-luggage-cart":"fa-luggage-cart", "fab fa-lyft":"fa-lyft", "fab fa-magento":"fa-magento", "fa fa-magic":"fa-magic", "fa fa-magnet":"fa-magnet", "fa fa-mail-bulk":"fa-mail-bulk", "fab fa-mailchimp":"fa-mailchimp", "fa fa-male":"fa-male", "fab fa-mandalorian":"fa-mandalorian", "fa fa-map":"fa-map", "fa fa-map-marked":"fa-map-marked", "fa fa-map-marked-alt":"fa-map-marked-alt", "fa fa-map-marker":"fa-map-marker", "fa fa-map-marker-alt":"fa-map-marker-alt", "fa fa-map-pin":"fa-map-pin", "fa fa-map-signs":"fa-map-signs", "fab fa-markdown":"fa-markdown", "fa fa-marker":"fa-marker", "fa fa-mars":"fa-mars", "fa fa-mars-double":"fa-mars-double", "fa fa-mars-stroke":"fa-mars-stroke", "fa fa-mars-stroke-h":"fa-mars-stroke-h", "fa fa-mars-stroke-v":"fa-mars-stroke-v", "fa fa-mask":"fa-mask", "fab fa-mastodon":"fa-mastodon", "fab fa-maxcdn":"fa-maxcdn", "fa fa-medal":"fa-medal", "fab fa-medapps":"fa-medapps", "fab fa-medium":"fa-medium", "fab fa-medium-m":"fa-medium-m", "fa fa-medkit":"fa-medkit", "fab fa-medrt":"fa-medrt", "fab fa-meetup":"fa-meetup", "fab fa-megaport":"fa-megaport", "fa fa-meh":"fa-meh", "fa fa-meh-blank":"fa-meh-blank", "fa fa-meh-rolling-eyes":"fa-meh-rolling-eyes", "fa fa-memory":"fa-memory", "fab fa-mendeley":"fa-mendeley", "fa fa-menorah":"fa-menorah", "fa fa-mercury":"fa-mercury", "fa fa-meteor":"fa-meteor", "fa fa-microchip":"fa-microchip", "fa fa-microphone":"fa-microphone", "fa fa-microphone-alt":"fa-microphone-alt", "fa fa-microphone-alt-slash":"fa-microphone-alt-slash", "fa fa-microphone-slash":"fa-microphone-slash", "fa fa-microscope":"fa-microscope", "fab fa-microsoft":"fa-microsoft", "fa fa-minus":"fa-minus", "fa fa-minus-circle":"fa-minus-circle", "fa fa-minus-square":"fa-minus-square", "fa fa-mitten":"fa-mitten", "fab fa-mix":"fa-mix", "fab fa-mixcloud":"fa-mixcloud", "fab fa-mizuni":"fa-mizuni", "fa fa-mobile":"fa-mobile", "fa fa-mobile-alt":"fa-mobile-alt", "fab fa-modx":"fa-modx", "fab fa-monero":"fa-monero", "fa fa-money-bill":"fa-money-bill", "fa fa-money-bill-alt":"fa-money-bill-alt", "fa fa-money-bill-wave":"fa-money-bill-wave", "fa fa-money-bill-wave-alt":"fa-money-bill-wave-alt", "fa fa-money-check":"fa-money-check", "fa fa-money-check-alt":"fa-money-check-alt", "fa fa-monument":"fa-monument", "fa fa-moon":"fa-moon", "fa fa-mortar-pestle":"fa-mortar-pestle", "fa fa-mosque":"fa-mosque", "fa fa-motorcycle":"fa-motorcycle", "fa fa-mountain":"fa-mountain", "fa fa-mouse-pointer":"fa-mouse-pointer", "fa fa-mug-hot":"fa-mug-hot", "fa fa-music":"fa-music", "fab fa-napster":"fa-napster", "fab fa-neos":"fa-neos", "fa fa-network-wired":"fa-network-wired", "fa fa-neuter":"fa-neuter", "fa fa-newspaper":"fa-newspaper", "fab fa-nimblr":"fa-nimblr", "fab fa-nintendo-switch":"fa-nintendo-switch", "fab fa-node":"fa-node", "fab fa-node-js":"fa-node-js", "fa fa-not-equal":"fa-not-equal", "fa fa-notes-medical":"fa-notes-medical", "fab fa-npm":"fa-npm", "fab fa-ns8":"fa-ns8", "fab fa-nutritionix":"fa-nutritionix", "fa fa-object-group":"fa-object-group", "fa fa-object-ungroup":"fa-object-ungroup", "fab fa-odnoklassniki":"fa-odnoklassniki", "fab fa-odnoklassniki-square":"fa-odnoklassniki-square", "fa fa-oil-can":"fa-oil-can", "fab fa-old-republic":"fa-old-republic", "fa fa-om":"fa-om", "fab fa-opencart":"fa-opencart", "fab fa-openid":"fa-openid", "fab fa-opera":"fa-opera", "fab fa-optin-monster":"fa-optin-monster", "fab fa-osi":"fa-osi", "fa fa-otter":"fa-otter", "fa fa-outdent":"fa-outdent", "fab fa-page4":"fa-page4", "fab fa-pagelines":"fa-pagelines", "fa fa-pager":"fa-pager", "fa fa-paint-brush":"fa-paint-brush", "fa fa-paint-roller":"fa-paint-roller", "fa fa-palette":"fa-palette", "fab fa-palfed":"fa-palfed", "fa fa-pallet":"fa-pallet", "fa fa-paper-plane":"fa-paper-plane", "fa fa-paperclip":"fa-paperclip", "fa fa-parachute-box":"fa-parachute-box", "fa fa-paragraph":"fa-paragraph", "fa fa-parking":"fa-parking", "fa fa-passport":"fa-passport", "fa fa-pastafarianism":"fa-pastafarianism", "fa fa-paste":"fa-paste", "fab fa-patreon":"fa-patreon", "fa fa-pause":"fa-pause", "fa fa-pause-circle":"fa-pause-circle", "fa fa-paw":"fa-paw", "fab fa-paypal":"fa-paypal", "fa fa-peace":"fa-peace", "fa fa-pen":"fa-pen", "fa fa-pen-alt":"fa-pen-alt", "fa fa-pen-fancy":"fa-pen-fancy", "fa fa-pen-nib":"fa-pen-nib", "fa fa-pen-square":"fa-pen-square", "fa fa-pencil-alt":"fa-pencil-alt", "fa fa-pencil-ruler":"fa-pencil-ruler", "fa fa-penny-arcade":"fa-penny-arcade", "fa fa-people-carry":"fa-people-carry", "fa fa-pepper-hot":"fa-pepper-hot", "fa fa-percent":"fa-percent", "fa fa-percentage":"fa-percentage", "fab fa-periscope":"fa-periscope", "fa fa-person-booth":"fa-person-booth", "fab fa-phabricator":"fa-phabricator", "fab fa-phoenix-framework":"fa-phoenix-framework", "fab fa-phoenix-squadron":"fa-phoenix-squadron", "fa fa-phone":"fa-phone", "fa fa-phone-slash":"fa-phone-slash", "fa fa-phone-square":"fa-phone-square", "fa fa-phone-volume":"fa-phone-volume", "fab fa-php":"fa-php", "fab fa-pied-piper":"fa-pied-piper", "fab fa-pied-piper-alt":"fa-pied-piper-alt", "fab fa-pied-piper-hat":"fa-pied-piper-hat", "fab fa-pied-piper-pp":"fa-pied-piper-pp", "fa fa-piggy-bank":"fa-piggy-bank", "fa fa-pills":"fa-pills", "fab fa-pinterest":"fa-pinterest", "fab fa-pinterest-p":"fa-pinterest-p", "fab fa-pinterest-square":"fa-pinterest-square", "fa fa-pizza-slice":"fa-pizza-slice", "fa fa-place-of-worship":"fa-place-of-worship", "fa fa-plane":"fa-plane", "fa fa-plane-arrival":"fa-plane-arrival", "fa fa-plane-departure":"fa-plane-departure", "fa fa-play":"fa-play", "fa fa-play-circle":"fa-play-circle", "fab fa-playstation":"fa-playstation", "fa fa-plug":"fa-plug", "fa fa-plus":"fa-plus", "fa fa-plus-circle":"fa-plus-circle", "fa fa-plus-square":"fa-plus-square", "fa fa-podcast":"fa-podcast", "fa fa-poll":"fa-poll", "fa fa-poll-h":"fa-poll-h", "fa fa-poo":"fa-poo", "fa fa-poo-storm":"fa-poo-storm", "fa fa-poop":"fa-poop", "fa fa-portrait":"fa-portrait", "fa fa-pound-sign":"fa-pound-sign", "fa fa-power-off":"fa-power-off", "fa fa-pray":"fa-pray", "fa fa-praying-hands":"fa-praying-hands", "fa fa-prescription":"fa-prescription", "fa fa-prescription-bottle":"fa-prescription-bottle", "fa fa-prescription-bottle-alt":"fa-prescription-bottle-alt", "fa fa-print":"fa-print", "fa fa-procedures":"fa-procedures", "fab fa-product-hunt":"fa-product-hunt", "fa fa-project-diagram":"fa-project-diagram", "fab fa-pushed":"fa-pushed", "fa fa-puzzle-piece":"fa-puzzle-piece", "fab fa-python":"fa-python", "fab fa-qq":"fa-qq", "fa fa-qrcode":"fa-qrcode", "fa fa-question":"fa-question", "fa fa-question-circle":"fa-question-circle", "fa fa-quidditch":"fa-quidditch", "fab fa-quinscape":"fa-quinscape", "fab fa-quora":"fa-quora", "fa fa-quote-left":"fa-quote-left", "fa fa-quote-right":"fa-quote-right", "fa fa-quran":"fa-quran", "fab fa-r-project":"fa-r-project", "fa fa-radiation":"fa-radiation", "fa fa-radiation-alt":"fa-radiation-alt", "fa fa-rainbow":"fa-rainbow", "fa fa-random":"fa-random", "fab fa-raspberry-pi":"fa-raspberry-pi", "fab fa-ravelry":"fa-ravelry", "fab fa-react":"fa-react", "fab fa-reacteurope":"fa-reacteurope", "fab fa-readme":"fa-readme", "fab fa-rebel":"fa-rebel", "fa fa-receipt":"fa-receipt", "fa fa-recycle":"fa-recycle", "fab fa-red-river":"fa-red-river", "fab fa-reddit":"fa-reddit", "fab fa-reddit-alien":"fa-reddit-alien", "fab fa-reddit-square":"fa-reddit-square", "fab fa-redhat":"fa-redhat", "fa fa-redo":"fa-redo", "fa fa-redo-alt":"fa-redo-alt", "fa fa-registered":"fa-registered", "fab fa-renren":"fa-renren", "fa fa-reply":"fa-reply", "fa fa-reply-all":"fa-reply-all", "fab fa-replyd":"fa-replyd", "fa fa-republican":"fa-republican", "fab fa-researchgate":"fa-researchgate", "fab fa-resolving":"fa-resolving", "fa fa-restroom":"fa-restroom", "fa fa-retweet":"fa-retweet", "fab fa-rev":"fa-rev", "fa fa-ribbon":"fa-ribbon", "fa fa-ring":"fa-ring", "fa fa-road":"fa-road", "fa fa-robot":"fa-robot", "fa fa-rocket":"fa-rocket", "fab fa-rocketchat":"fa-rocketchat", "fab fa-rockrms":"fa-rockrms", "fa fa-route":"fa-route", "fa fa-rss":"fa-rss", "fa fa-rss-square":"fa-rss-square", "fa fa-ruble-sign":"fa-ruble-sign", "fa fa-ruler":"fa-ruler", "fa fa-ruler-combined":"fa-ruler-combined", "fa fa-ruler-horizontal":"fa-ruler-horizontal", "fa fa-ruler-vertical":"fa-ruler-vertical", "fa fa-running":"fa-running", "fa fa-rupee-sign":"fa-rupee-sign", "fa fa-sad-cry":"fa-sad-cry", "fa fa-sad-tear":"fa-sad-tear", "fab fa-safari":"fa-safari", "fab fa-salesforce":"fa-salesforce", "fab fa-sass":"fa-sass", "fa fa-satellite":"fa-satellite", "fa fa-satellite-dish":"fa-satellite-dish", "fa fa-save":"fa-save", "fab fa-schlix":"fa-schlix", "fa fa-school":"fa-school", "fa fa-screwdriver":"fa-screwdriver", "fab fa-scribd":"fa-scribd", "fa fa-scroll":"fa-scroll", "fa fa-sd-card":"fa-sd-card", "fa fa-search":"fa-search", "fa fa-search-dollar":"fa-search-dollar", "fa fa-search-location":"fa-search-location", "fa fa-search-minus":"fa-search-minus", "fa fa-search-plus":"fa-search-plus", "fab fa-searchengin":"fa-searchengin", "fa fa-seedling":"fa-seedling", "fab fa-sellcast":"fa-sellcast", "fab fa-sellsy":"fa-sellsy", "fa fa-server":"fa-server", "fab fa-servicestack":"fa-servicestack", "fa fa-shapes":"fa-shapes", "fa fa-share":"fa-share", "fa fa-share-alt":"fa-share-alt", "fa fa-share-alt-square":"fa-share-alt-square", "fa fa-share-square":"fa-share-square", "fa fa-shekel-sign":"fa-shekel-sign", "fa fa-shield-alt":"fa-shield-alt", "fa fa-ship":"fa-ship", "fa fa-shipping-fast":"fa-shipping-fast", "fab fa-shirtsinbulk":"fa-shirtsinbulk", "fa fa-shoe-prints":"fa-shoe-prints", "fa fa-shopping-bag":"fa-shopping-bag", "fa fa-shopping-basket":"fa-shopping-basket", "fa fa-shopping-cart":"fa-shopping-cart", "fab fa-shopware":"fa-shopware", "fa fa-shower":"fa-shower", "fa fa-shuttle-van":"fa-shuttle-van", "fa fa-sign":"fa-sign", "fa fa-sign-in-alt":"fa-sign-in-alt", "fa fa-sign-language":"fa-sign-language", "fa fa-sign-out-alt":"fa-sign-out-alt", "fa fa-signal":"fa-signal", "fa fa-signature":"fa-signature", "fa fa-sim-card":"fa-sim-card", "fab fa-simplybuilt":"fa-simplybuilt", "fab fa-sistrix":"fa-sistrix", "fa fa-sitemap":"fa-sitemap", "fab fa-sith":"fa-sith", "fa fa-skating":"fa-skating", "fab fa-sketch":"fa-sketch", "fa fa-skiing":"fa-skiing", "fa fa-skiing-nordic":"fa-skiing-nordic", "fa fa-skull":"fa-skull", "fa fa-skull-crossbones":"fa-skull-crossbones", "fab fa-skyatlas":"fa-skyatlas", "fab fa-skype":"fa-skype", "fab fa-slack":"fa-slack", "fab fa-slack-hash":"fa-slack-hash", "fa fa-slash":"fa-slash", "fa fa-sleigh":"fa-sleigh", "fa fa-sliders-h":"fa-sliders-h", "fab fa-slideshare":"fa-slideshare", "fa fa-smile":"fa-smile", "fa fa-smile-beam":"fa-smile-beam", "fa fa-smile-wink":"fa-smile-wink", "fa fa-smog":"fa-smog", "fa fa-smoking":"fa-smoking", "fa fa-smoking-ban":"fa-smoking-ban", "fa fa-sms":"fa-sms", "fab fa-snapchat":"fa-snapchat", "fab fa-snapchat-ghost":"fa-snapchat-ghost", "fab fa-snapchat-square":"fa-snapchat-square", "fa fa-snowboarding":"fa-snowboarding", "fa fa-snowflake":"fa-snowflake", "fa fa-snowman":"fa-snowman", "fa fa-snowplow":"fa-snowplow", "fa fa-socks":"fa-socks", "fa fa-solar-panel":"fa-solar-panel", "fa fa-sort":"fa-sort", "fa fa-sort-alpha-down":"fa-sort-alpha-down", "fa fa-sort-alpha-up":"fa-sort-alpha-up", "fa fa-sort-amount-down":"fa-sort-amount-down", "fa fa-sort-amount-up":"fa-sort-amount-up", "fa fa-sort-down":"fa-sort-down", "fa fa-sort-numeric-down":"fa-sort-numeric-down", "fa fa-sort-numeric-up":"fa-sort-numeric-up", "fa fa-sort-up":"fa-sort-up", "fab fa-soundcloud":"fa-soundcloud", "fab fa-sourcetree":"fa-sourcetree", "fa fa-spa":"fa-spa", "fa fa-space-shuttle":"fa-space-shuttle", "fab fa-speakap":"fa-speakap", "fab fa-speaker-deck":"fa-speaker-deck", "fa fa-spider":"fa-spider", "fa fa-spinner":"fa-spinner", "fa fa-splotch":"fa-splotch", "fab fa-spotify":"fa-spotify", "fa fa-spray-can":"fa-spray-can", "fa fa-square":"fa-square", "fa fa-square-full":"fa-square-full", "fa fa-square-root-alt":"fa-square-root-alt", "fab fa-squarespace":"fa-squarespace", "fab fa-stack-exchange":"fa-stack-exchange", "fab fa-stack-overflow":"fa-stack-overflow", "fa fa-stamp":"fa-stamp", "fa fa-star":"fa-star", "fa fa-star-and-crescent":"fa-star-and-crescent", "fa fa-star-half":"fa-star-half", "fa fa-star-half-alt":"fa-star-half-alt", "fa fa-star-of-david":"fa-star-of-david", "fa fa-star-of-life":"fa-star-of-life", "fab fa-staylinked":"fa-staylinked", "fab fa-steam":"fa-steam", "fab fa-steam-square":"fa-steam-square", "fab fa-steam-symbol":"fa-steam-symbol", "fa fa-step-backward":"fa-step-backward", "fa fa-step-forward":"fa-step-forward", "fa fa-stethoscope":"fa-stethoscope", "fab fa-sticker-mule":"fa-sticker-mule", "fa fa-sticky-note":"fa-sticky-note", "fa fa-stop":"fa-stop", "fa fa-stop-circle":"fa-stop-circle", "fa fa-stopwatch":"fa-stopwatch", "fa fa-store":"fa-store", "fa fa-store-alt":"fa-store-alt", "fab fa-strava":"fa-strava", "fa fa-stream":"fa-stream", "fa fa-street-view":"fa-street-view", "fa fa-strikethrough":"fa-strikethrough", "fab fa-stripe":"fa-stripe", "fab fa-stripe-s":"fa-stripe-s", "fa fa-stroopwafel":"fa-stroopwafel", "fab fa-studiovinari":"fa-studiovinari", "fab fa-stumbleupon":"fa-stumbleupon", "fab fa-stumbleupon-circle":"fa-stumbleupon-circle", "fa fa-subscript":"fa-subscript", "fa fa-subway":"fa-subway", "fa fa-suitcase":"fa-suitcase", "fa fa-suitcase-rolling":"fa-suitcase-rolling", "fa fa-sun":"fa-sun", "fab fa-superpowers":"fa-superpowers", "fa fa-superscript":"fa-superscript", "fab fa-supple":"fa-supple", "fa fa-surprise":"fa-surprise", "fa fa-suse":"fa-suse", "fa fa-swatchbook":"fa-swatchbook", "fa fa-swimmer":"fa-swimmer", "fa fa-swimming-pool":"fa-swimming-pool", "fab fa-symfony":"fa-symfony", "fa fa-synagogue":"fa-synagogue", "fa fa-sync":"fa-sync", "fa fa-sync-alt":"fa-sync-alt", "fa fa-syringe":"fa-syringe", "fa fa-table":"fa-table", "fa fa-table-tennis":"fa-table-tennis", "fa fa-tablet":"fa-tablet", "fa fa-tablet-alt":"fa-tablet-alt", "fa fa-tablets":"fa-tablets", "fa fa-tachometer-alt":"fa-tachometer-alt", "fa fa-tag":"fa-tag", "fa fa-tags":"fa-tags", "fa fa-tape":"fa-tape", "fa fa-tasks":"fa-tasks", "fa fa-taxi":"fa-taxi", "fab fa-teamspeak":"fa-teamspeak", "fa fa-teeth":"fa-teeth", "fa fa-teeth-open":"fa-teeth-open", "fab fa-telegram":"fa-telegram", "fab fa-telegram-plane":"fa-telegram-plane", "fa fa-temperature-high":"fa-temperature-high", "fa fa-temperature-low":"fa-temperature-low", "fab fa-tencent-weibo":"fa-tencent-weibo", "fa fa-tenge":"fa-tenge", "fa fa-terminal":"fa-terminal", "fa fa-text-height":"fa-text-height", "fa fa-text-width":"fa-text-width", "fa fa-th":"fa-th", "fa fa-th-large":"fa-th-large", "fa fa-th-list":"fa-th-list", "fab fa-the-red-yeti":"fa-the-red-yeti", "fa fa-theater-masks":"fa-theater-masks", "fab fa-themeco":"fa-themeco", "fab fa-themeisle":"fa-themeisle", "fa fa-thermometer":"fa-thermometer", "fa fa-thermometer-empty":"fa-thermometer-empty", "fa fa-thermometer-full":"fa-thermometer-full", "fa fa-thermometer-half":"fa-thermometer-half", "fa fa-thermometer-quarter":"fa-thermometer-quarter", "fa fa-thermometer-three-quarters":"fa-thermometer-three-quarters", "fab fa-think-peaks":"fa-think-peaks", "fa fa-thumbs-down":"fa-thumbs-down", "fa fa-thumbs-up":"fa-thumbs-up", "fa fa-thumbtack":"fa-thumbtack", "fa fa-ticket-alt":"fa-ticket-alt", "fa fa-times":"fa-times", "fa fa-times-circle":"fa-times-circle", "fa fa-tint":"fa-tint", "fa fa-tint-slash":"fa-tint-slash", "fa fa-tired":"fa-tired", "fa fa-toggle-off":"fa-toggle-off", "fa fa-toggle-on":"fa-toggle-on", "fa fa-toilet":"fa-toilet", "fa fa-toilet-paper":"fa-toilet-paper", "fa fa-toolbox":"fa-toolbox", "fa fa-tools":"fa-tools", "fa fa-tooth":"fa-tooth", "fa fa-torah":"fa-torah", "fa fa-torii-gate":"fa-torii-gate", "fa fa-tractor":"fa-tractor", "fab fa-trade-federation":"fa-trade-federation", "fa fa-trademark":"fa-trademark", "fa fa-traffic-light":"fa-traffic-light", "fa fa-train":"fa-train", "fa fa-tram":"fa-tram", "fa fa-transgender":"fa-transgender", "fa fa-transgender-alt":"fa-transgender-alt", "fa fa-trash":"fa-trash", "fa fa-trash-alt":"fa-trash-alt", "fa fa-trash-restore":"fa-trash-restore", "fa fa-trash-restore-alt":"fa-trash-restore-alt", "fa fa-tree":"fa-tree", "fab fa-trello":"fa-trello", "fab fa-tripadvisor":"fa-tripadvisor", "fa fa-trophy":"fa-trophy", "fa fa-truck":"fa-truck", "fa fa-truck-loading":"fa-truck-loading", "fa fa-truck-monster":"fa-truck-monster", "fa fa-truck-moving":"fa-truck-moving", "fa fa-truck-pickup":"fa-truck-pickup", "fa fa-tshirt":"fa-tshirt", "fa fa-tty":"fa-tty", "fab fa-tumblr":"fa-tumblr", "fab fa-tumblr-square":"fa-tumblr-square", "fa fa-tv":"fa-tv", "fab fa-twitch":"fa-twitch", "fab fa-twitter":"fa-twitter", "fab fa-twitter-square":"fa-twitter-square", "fab fa-typo3":"fa-typo3", "fab fa-uber":"fa-uber", "fab fa-ubuntu":"fa-ubuntu", "fab fa-uikit":"fa-uikit", "fa fa-umbrella":"fa-umbrella", "fa fa-umbrella-beach":"fa-umbrella-beach", "fa fa-underline":"fa-underline", "fa fa-undo":"fa-undo", "fa fa-undo-alt":"fa-undo-alt", "fab fa-uniregistry":"fa-uniregistry", "fa fa-universal-access":"fa-universal-access", "fa fa-university":"fa-university", "fa fa-unlink":"fa-unlink", "fa fa-unlock":"fa-unlock", "fa fa-unlock-alt":"fa-unlock-alt", "fab fa-untappd":"fa-untappd", "fa fa-upload":"fa-upload", "fab fa-ups":"fa-ups", "fab fa-usb":"fa-usb", "fa fa-user":"fa-user", "fa fa-user-alt":"fa-user-alt", "fa fa-user-alt-slash":"fa-user-alt-slash", "fa fa-user-astronaut":"fa-user-astronaut", "fa fa-user-check":"fa-user-check", "fa fa-user-circle":"fa-user-circle", "fa fa-user-clock":"fa-user-clock", "fa fa-user-cog":"fa-user-cog", "fa fa-user-edit":"fa-user-edit", "fa fa-user-friends":"fa-user-friends", "fa fa-user-graduate":"fa-user-graduate", "fa fa-user-injured":"fa-user-injured", "fa fa-user-lock":"fa-user-lock", "fa fa-user-md":"fa-user-md", "fa fa-user-minus":"fa-user-minus", "fa fa-user-ninja":"fa-user-ninja", "fa fa-user-nurse":"fa-user-nurse", "fa fa-user-plus":"fa-user-plus", "fa fa-user-secret":"fa-user-secret", "fa fa-user-shield":"fa-user-shield", "fa fa-user-slash":"fa-user-slash", "fa fa-user-tag":"fa-user-tag", "fa fa-user-tie":"fa-user-tie", "fa fa-user-times":"fa-user-times", "fa fa-users":"fa-users", "fa fa-users-cog":"fa-users-cog", "fab fa-usps":"fa-usps", "fab fa-ussunnah":"fa-ussunnah", "fa fa-utensil-spoon":"fa-utensil-spoon", "fa fa-utensils":"fa-utensils", "fab fa-vaadin":"fa-vaadin", "fa fa-vector-square":"fa-vector-square", "fa fa-venus":"fa-venus", "fa fa-venus-double":"fa-venus-double", "fa fa-venus-mars":"fa-venus-mars", "fab fa-viacoin":"fa-viacoin", "fab fa-viadeo":"fa-viadeo", "fab fa-viadeo-square":"fa-viadeo-square", "fa fa-vial":"fa-vial", "fa fa-vials":"fa-vials", "fab fa-viber":"fa-viber", "fa fa-video":"fa-video", "fa fa-video-slash":"fa-video-slash", "fa fa-vihara":"fa-vihara", "fab fa-vimeo":"fa-vimeo", "fab fa-vimeo-square":"fa-vimeo-square", "fab fa-vimeo-v":"fa-vimeo-v", "fab fa-vine":"fa-vine", "fab fa-vk":"fa-vk", "fab fa-vnv":"fa-vnv", "fa fa-volleyball-ball":"fa-volleyball-ball", "fa fa-volume-down":"fa-volume-down", "fa fa-volume-mute":"fa-volume-mute", "fa fa-volume-off":"fa-volume-off", "fa fa-volume-up":"fa-volume-up", "fa fa-vote-yea":"fa-vote-yea", "fa fa-vr-cardboard":"fa-vr-cardboard", "fab fa-vuejs":"fa-vuejs", "fa fa-walking":"fa-walking", "fa fa-wallet":"fa-wallet", "fa fa-warehouse":"fa-warehouse", "fa fa-water":"fa-water", "fa fa-wave-square":"fa-wave-square", "fab fa-waze":"fa-waze", "fab fa-weebly":"fa-weebly", "fab fa-weibo":"fa-weibo", "fa fa-weight":"fa-weight", "fa fa-weight-hanging":"fa-weight-hanging", "fab fa-weixin":"fa-weixin", "fab fa-whatsapp":"fa-whatsapp", "fab fa-whatsapp-square":"fa-whatsapp-square", "fa fa-wheelchair":"fa-wheelchair", "fab fa-whmcs":"fa-whmcs", "fa fa-wifi":"fa-wifi", "fab fa-wikipedia-w":"fa-wikipedia-w", "fa fa-wind":"fa-wind", "fa fa-window-close":"fa-window-close", "fa fa-window-maximize":"fa-window-maximize", "fa fa-window-minimize":"fa-window-minimize", "fa fa-window-restore":"fa-window-restore", "fab fa-windows":"fa-windows", "fa fa-wine-bottle":"fa-wine-bottle", "fa fa-wine-glass":"fa-wine-glass", "fa fa-wine-glass-alt":"fa-wine-glass-alt", "fab fa-wix":"fa-wix", "fab fa-wizards-of-the-coast":"fa-wizards-of-the-coast", "fab fa-wolf-pack-battalion":"fa-wolf-pack-battalion", "fa fa-won-sign":"fa-won-sign", "fab fa-wordpress":"fa-wordpress", "fab fa-wordpress-simple":"fa-wordpress-simple", "fab fa-wpbeginner":"fa-wpbeginner", "fab fa-wpexplorer":"fa-wpexplorer", "fab fa-wpforms":"fa-wpforms", "fab fa-wpressr":"fa-wpressr", "fa fa-wrench":"fa-wrench", "fa fa-x-ray":"fa-x-ray", "fab fa-xbox":"fa-xbox", "fab fa-xing":"fa-xing", "fab fa-xing-square":"fa-xing-square", "fab fa-y-combinator":"fa-y-combinator", "fab fa-yahoo":"fa-yahoo", "fab fa-yammer":"fa-yammer", "fab fa-yandex":"fa-yandex", "fab fa-yandex-international":"fa-yandex-international", "fab fa-yarn":"fa-yarn", "fab fa-yelp":"fa-yelp", "fa fa-yen-sign":"fa-yen-sign", "fa fa-yin-yang":"fa-yin-yang", "fab fa-yoast":"fa-yoast", "fab fa-youtube":"fa-youtube", "fab fa-youtube-square":"fa-youtube-square", "fab fa-zhihu":"fa-zhihu"
                }';
        $fontawesome = json_decode($json);
        return $fontawesome;
    }
}

if (!function_exists("flaticon")) {
    function flaticon()
    {
        $json = '{"flaticon-email-black-circular-button":"flaticon-email-black-circular-button","flaticon-map":"flaticon-map",
            "flaticon-alert-off":"flaticon-alert-off","flaticon-alert":"flaticon-alert","flaticon-computer":"flaticon-computer",
            "flaticon-responsive":"flaticon-responsive","flaticon-presentation":"flaticon-presentation","flaticon-arrows":"flaticon-arrows",
            "flaticon-rocket":"flaticon-rocket","flaticon-reply":"flaticon-reply","flaticon-gift":"flaticon-gift","flaticon-confetti":"flaticon-confetti",
            "flaticon-piggy-bank":"flaticon-piggy-bank","flaticon-support":"flaticon-support","flaticon-delete":"flaticon-delete","flaticon-eye":"flaticon-eye",
            "flaticon-multimedia":"flaticon-multimedia","flaticon-whatsapp":"flaticon-whatsapp","flaticon-multimedia-2":"flaticon-multimedia-2",
            "flaticon-email":"flaticon-email","flaticon-presentation-1":"flaticon-presentation-1","flaticon-trophy":"flaticon-trophy","flaticon-psd":"flaticon-psd",
            "flaticon-layer":"flaticon-layer","flaticon-doc":"flaticon-doc","flaticon-file":"flaticon-file","flaticon-network":"flaticon-network",
            "flaticon-bus-stop":"flaticon-bus-stop","flaticon-globe":"flaticon-globe","flaticon-upload":"flaticon-upload","flaticon-squares":"flaticon-squares",
            "flaticon-technology":"flaticon-technology","flaticon-up-arrow":"flaticon-up-arrow","flaticon-browser":"flaticon-browser",
            "flaticon-speech-bubble":"flaticon-speech-bubble","flaticon-coins":"flaticon-coins","flaticon-open-box":"flaticon-open-box",
            "flaticon-speech-bubble-1":"flaticon-speech-bubble-1","flaticon-attachment":"flaticon-attachment","flaticon-photo-camera":"flaticon-photo-camera",
            "flaticon-skype-logo":"flaticon-skype-logo","flaticon-linkedin-logo":"flaticon-linkedin-logo","flaticon-twitter-logo":"flaticon-twitter-logo",
            "flaticon-facebook-letter-logo":"flaticon-facebook-letter-logo","flaticon-calendar-with-a-clock-time-tools":"flaticon-calendar-with-a-clock-time-tools",
            "flaticon-youtube":"flaticon-youtube","flaticon-add-circular-button":"flaticon-add-circular-button","flaticon-more-v2":"flaticon-more-v2",
            "flaticon-search":"flaticon-search","flaticon-search-magnifier-interface-symbol":"flaticon-search-magnifier-interface-symbol",
            "flaticon-questions-circular-button":"flaticon-questions-circular-button","flaticon-refresh":"flaticon-refresh","flaticon-logout":"flaticon-logout",
            "flaticon-event-calendar-symbol":"flaticon-event-calendar-symbol","flaticon-laptop":"flaticon-laptop","flaticon-tool":"flaticon-tool",
            "flaticon-graphic":"flaticon-graphic","flaticon-symbol":"flaticon-symbol","flaticon-graphic-1":"flaticon-graphic-1","flaticon-clock":"flaticon-clock",
            "flaticon-squares-1":"flaticon-squares-1","flaticon-black":"flaticon-black","flaticon-book":"flaticon-book","flaticon-cogwheel":"flaticon-cogwheel",
            "flaticon-exclamation":"flaticon-exclamation","flaticon-add-label-button":"flaticon-add-label-button","flaticon-delete-1":"flaticon-delete-1",
            "flaticon-interface":"flaticon-interface","flaticon-more":"flaticon-more","flaticon-warning-sign":"flaticon-warning-sign","flaticon-calendar":"flaticon-calendar",
            "flaticon-instagram-logo":"flaticon-instagram-logo","flaticon-linkedin":"flaticon-linkedin","flaticon-facebook-logo-button":"flaticon-facebook-logo-button",
            "flaticon-twitter-logo-button":"flaticon-twitter-logo-button","flaticon-cancel":"flaticon-cancel","flaticon-exclamation-square":"flaticon-exclamation-square",
            "flaticon-buildings":"flaticon-buildings","flaticon-danger":"flaticon-danger","flaticon-technology-1":"flaticon-technology-1",
            "flaticon-letter-g":"flaticon-letter-g","flaticon-interface-1":"flaticon-interface-1","flaticon-circle":"flaticon-circle","flaticon-pin":"flaticon-pin",
            "flaticon-close":"flaticon-close","flaticon-clock-1":"flaticon-clock-1","flaticon-apps":"flaticon-apps","flaticon-user":"flaticon-user",
            "flaticon-menu-button":"flaticon-menu-button","flaticon-settings":"flaticon-settings","flaticon-home":"flaticon-home","flaticon-clock-2":"flaticon-clock-2",
            "flaticon-lifebuoy":"flaticon-lifebuoy","flaticon-cogwheel-1":"flaticon-cogwheel-1","flaticon-paper-plane":"flaticon-paper-plane",
            "flaticon-statistics":"flaticon-statistics","flaticon-diagram":"flaticon-diagram","flaticon-line-graph":"flaticon-line-graph",
            "flaticon-customer":"flaticon-customer","flaticon-visible":"flaticon-visible","flaticon-shopping-basket":"flaticon-shopping-basket",
            "flaticon-price-tag":"flaticon-price-tag","flaticon-businesswoman":"flaticon-businesswoman","flaticon-medal":"flaticon-medal","flaticon-like":"flaticon-like",
            "flaticon-edit":"flaticon-edit","flaticon-avatar":"flaticon-avatar","flaticon-download":"flaticon-download","flaticon-home-1":"flaticon-home-1",
            "flaticon-mail":"flaticon-mail","flaticon-mail-1":"flaticon-mail-1","flaticon-warning":"flaticon-warning","flaticon-cart":"flaticon-cart",
            "flaticon-bag":"flaticon-bag","flaticon-pie-chart":"flaticon-pie-chart","flaticon-graph":"flaticon-graph","flaticon-interface-2":"flaticon-interface-2",
            "flaticon-chat":"flaticon-chat","flaticon-envelope":"flaticon-envelope","flaticon-chat-1":"flaticon-chat-1","flaticon-interface-3":"flaticon-interface-3",
            "flaticon-background":"flaticon-background","flaticon-file-1":"flaticon-file-1","flaticon-interface-4":"flaticon-interface-4",
            "flaticon-multimedia-3":"flaticon-multimedia-3","flaticon-list":"flaticon-list","flaticon-time":"flaticon-time","flaticon-profile":"flaticon-profile",
            "flaticon-imac":"flaticon-imac","flaticon-medical":"flaticon-medical","flaticon-music":"flaticon-music","flaticon-plus":"flaticon-plus",
            "flaticon-exclamation-1":"flaticon-exclamation-1","flaticon-info":"flaticon-info","flaticon-menu-1":"flaticon-menu-1","flaticon-menu-2":"flaticon-menu-2",
            "flaticon-share":"flaticon-share","flaticon-interface-5":"flaticon-interface-5","flaticon-signs":"flaticon-signs","flaticon-tabs":"flaticon-tabs",
            "flaticon-multimedia-4":"flaticon-multimedia-4","flaticon-upload-1":"flaticon-upload-1","flaticon-web":"flaticon-web",
            "flaticon-placeholder":"flaticon-placeholder","flaticon-placeholder-1":"flaticon-placeholder-1","flaticon-layers":"flaticon-layers",
            "flaticon-interface-6":"flaticon-interface-6","flaticon-interface-7":"flaticon-interface-7","flaticon-interface-8":"flaticon-interface-8",
            "flaticon-tool-1":"flaticon-tool-1","flaticon-settings-1":"flaticon-settings-1","flaticon-alarm":"flaticon-alarm","flaticon-search-1":"flaticon-search-1",
            "flaticon-time-1":"flaticon-time-1","flaticon-stopwatch":"flaticon-stopwatch","flaticon-folder":"flaticon-folder","flaticon-folder-1":"flaticon-folder-1",
            "flaticon-folder-2":"flaticon-folder-2","flaticon-folder-3":"flaticon-folder-3","flaticon-file-2":"flaticon-file-2","flaticon-list-1":"flaticon-list-1",
            "flaticon-list-2":"flaticon-list-2","flaticon-calendar-1":"flaticon-calendar-1","flaticon-time-2":"flaticon-time-2","flaticon-interface-9":"flaticon-interface-9",
            "flaticon-app":"flaticon-app","flaticon-suitcase":"flaticon-suitcase","flaticon-grid-menu-v2":"flaticon-grid-menu-v2","flaticon-more-v6":"flaticon-more-v6",
            "flaticon-more-v5":"flaticon-more-v5","flaticon-add":"flaticon-add","flaticon-multimedia-5":"flaticon-multimedia-5","flaticon-more-v4":"flaticon-more-v4",
            "flaticon-placeholder-2":"flaticon-placeholder-2","flaticon-map-location":"flaticon-map-location","flaticon-users":"flaticon-users",
            "flaticon-profile-1":"flaticon-profile-1","flaticon-lock":"flaticon-lock","flaticon-sound":"flaticon-sound","flaticon-star":"flaticon-star",
            "flaticon-placeholder-3":"flaticon-placeholder-3","flaticon-bell":"flaticon-bell","flaticon-paper-plane-1":"flaticon-paper-plane-1",
            "flaticon-users-1":"flaticon-users-1","flaticon-more-1":"flaticon-more-1","flaticon-up-arrow-1":"flaticon-up-arrow-1","flaticon-grid-menu":"flaticon-grid-menu",
            "flaticon-alarm-1":"flaticon-alarm-1","flaticon-earth-globe":"flaticon-earth-globe","flaticon-alert-1":"flaticon-alert-1","flaticon-internet":"flaticon-internet",
            "flaticon-user-ok":"flaticon-user-ok","flaticon-user-add":"flaticon-user-add","flaticon-user-settings":"flaticon-user-settings","flaticon-truck":"flaticon-truck",
            "flaticon-analytics":"flaticon-analytics","flaticon-notes":"flaticon-notes","flaticon-tea-cup":"flaticon-tea-cup","flaticon-exclamation-2":"flaticon-exclamation-2",
            "flaticon-technology-2":"flaticon-technology-2","flaticon-location":"flaticon-location","flaticon-edit-1":"flaticon-edit-1","flaticon-home-2":"flaticon-home-2",
            "flaticon-dashboard":"flaticon-dashboard","flaticon-information":"flaticon-information","flaticon-light":"flaticon-light","flaticon-car":"flaticon-car",
            "flaticon-business":"flaticon-business","flaticon-squares-2":"flaticon-squares-2","flaticon-signs-1":"flaticon-signs-1","flaticon-mark":"flaticon-mark",
            "flaticon-squares-3":"flaticon-squares-3","flaticon-comment":"flaticon-comment","flaticon-shapes":"flaticon-shapes","flaticon-clipboard":"flaticon-clipboard",
            "flaticon-squares-4":"flaticon-squares-4","flaticon-delete-2":"flaticon-delete-2","flaticon-bell-1":"flaticon-bell-1","flaticon-list-3":"flaticon-list-3",
            "flaticon-infinity":"flaticon-infinity","flaticon-chat-2":"flaticon-chat-2","flaticon-calendar-2":"flaticon-calendar-2","flaticon-signs-2":"flaticon-signs-2",
            "flaticon-time-3":"flaticon-time-3","flaticon-calendar-3":"flaticon-calendar-3","flaticon-interface-10":"flaticon-interface-10",
            "flaticon-interface-11":"flaticon-interface-11","flaticon-folder-4":"flaticon-folder-4","flaticon-alert-2":"flaticon-alert-2",
            "flaticon-cogwheel-2":"flaticon-cogwheel-2",
            "flaticon-graphic-2":"flaticon-graphic-2","flaticon-rotate":"flaticon-rotate","flaticon-feed":"flaticon-feed",
            "flaticon-safe-shield-protection":"flaticon-safe-shield-protection","flaticon-security":"flaticon-security","flaticon-download-1":"flaticon-download-1",
            "flaticon-pie-chart-1":"flaticon-pie-chart-1","flaticon-notepad":"flaticon-notepad","flaticon2-notification":"flaticon2-notification",
            "flaticon2-settings":"flaticon2-settings","flaticon2-search":"flaticon2-search","flaticon2-delete":"flaticon2-delete","flaticon2-psd":"flaticon2-psd",
            "flaticon2-list":"flaticon2-list","flaticon2-box":"flaticon2-box","flaticon2-download":"flaticon2-download","flaticon2-shield":"flaticon2-shield",
            "flaticon2-paperplane":"flaticon2-paperplane","flaticon2-avatar":"flaticon2-avatar","flaticon2-bell":"flaticon2-bell","flaticon2-fax":"flaticon2-fax",
            "flaticon2-chart2":"flaticon2-chart2","flaticon2-supermarket":"flaticon2-supermarket","flaticon2-phone":"flaticon2-phone",
            "flaticon2-envelope":"flaticon2-envelope","flaticon2-pin":"flaticon2-pin","flaticon2-chat":"flaticon2-chat","flaticon2-chart":"flaticon2-chart",
            "flaticon2-infographic":"flaticon2-infographic","flaticon2-grids":"flaticon2-grids","flaticon2-menu":"flaticon2-menu","flaticon2-plus":"flaticon2-plus",
            "flaticon2-list-1":"flaticon2-list-1","flaticon2-talk":"flaticon2-talk","flaticon2-file":"flaticon2-file","flaticon2-user":"flaticon2-user",
            "flaticon2-line-chart":"flaticon2-line-chart","flaticon2-percentage":"flaticon2-percentage","flaticon2-menu-1":"flaticon2-menu-1",
            "flaticon2-paper-plane":"flaticon2-paper-plane","flaticon2-menu-2":"flaticon2-menu-2","flaticon2-shopping-cart":"flaticon2-shopping-cart",
            "flaticon2-pie-chart":"flaticon2-pie-chart","flaticon2-box-1":"flaticon2-box-1","flaticon2-map":"flaticon2-map","flaticon2-favourite":"flaticon2-favourite",
            "flaticon2-checking":"flaticon2-checking","flaticon2-safe":"flaticon2-safe","flaticon2-heart-rate-monitor":"flaticon2-heart-rate-monitor",
            "flaticon2-layers":"flaticon2-layers","flaticon2-delivery-package":"flaticon2-delivery-package","flaticon2-sms":"flaticon2-sms",
            "flaticon2-image-file":"flaticon2-image-file","flaticon2-plus-1":"flaticon2-plus-1","flaticon2-send":"flaticon2-send",
            "flaticon2-graphic-design":"flaticon2-graphic-design","flaticon2-cup":"flaticon2-cup","flaticon2-website":"flaticon2-website","flaticon2-gift":"flaticon2-gift",
            "flaticon2-chronometer":"flaticon2-chronometer","flaticon2-bar-chart":"flaticon2-bar-chart","flaticon2-browser":"flaticon2-browser",
            "flaticon2-digital-marketing":"flaticon2-digital-marketing","flaticon2-calendar":"flaticon2-calendar","flaticon2-calendar-1":"flaticon2-calendar-1",
            "flaticon2-rocket":"flaticon2-rocket","flaticon2-analytics":"flaticon2-analytics","flaticon2-pie-chart-1":"flaticon2-pie-chart-1",
            "flaticon2-pie-chart-2":"flaticon2-pie-chart-2","flaticon2-analytics-1":"flaticon2-analytics-1","flaticon2-google-drive-file":"flaticon2-google-drive-file",
            "flaticon2-pie-chart-3":"flaticon2-pie-chart-3","flaticon2-poll-symbol":"flaticon2-poll-symbol","flaticon2-gear":"flaticon2-gear",
            "flaticon2-magnifier-tool":"flaticon2-magnifier-tool","flaticon2-add":"flaticon2-add","flaticon2-cube":"flaticon2-cube","flaticon2-gift-1":"flaticon2-gift-1",
            "flaticon2-list-2":"flaticon2-list-2","flaticon2-shopping-cart-1":"flaticon2-shopping-cart-1","flaticon2-calendar-2":"flaticon2-calendar-2",
            "flaticon2-laptop":"flaticon2-laptop","flaticon2-cube-1":"flaticon2-cube-1","flaticon2-layers-1":"flaticon2-layers-1","flaticon2-chat-1":"flaticon2-chat-1",
            "flaticon2-copy":"flaticon2-copy","flaticon2-paper":"flaticon2-paper","flaticon2-hospital":"flaticon2-hospital","flaticon2-calendar-3":"flaticon2-calendar-3",
            "flaticon2-speaker":"flaticon2-speaker","flaticon2-pie-chart-4":"flaticon2-pie-chart-4","flaticon2-schedule":"flaticon2-schedule",
            "flaticon2-expand":"flaticon2-expand","flaticon2-menu-3":"flaticon2-menu-3","flaticon2-download-1":"flaticon2-download-1","flaticon2-help":"flaticon2-help",
            "flaticon2-list-3":"flaticon2-list-3","flaticon2-notepad":"flaticon2-notepad","flaticon2-graph":"flaticon2-graph","flaticon2-browser-1":"flaticon2-browser-1",
            "flaticon2-photograph":"flaticon2-photograph","flaticon2-browser-2":"flaticon2-browser-2","flaticon2-hourglass":"flaticon2-hourglass",
            "flaticon2-mail":"flaticon2-mail","flaticon2-cardiogram":"flaticon2-cardiogram","flaticon2-document":"flaticon2-document",
            "flaticon2-contract":"flaticon2-contract","flaticon2-graph-1":"flaticon2-graph-1","flaticon2-graphic":"flaticon2-graphic",
            "flaticon2-position":"flaticon2-position","flaticon2-soft-icons":"flaticon2-soft-icons","flaticon2-circle-vol-2":"flaticon2-circle-vol-2",
            "flaticon2-rocket-1":"flaticon2-rocket-1","flaticon2-lorry":"flaticon2-lorry","flaticon2-cd":"flaticon2-cd","flaticon2-file-1":"flaticon2-file-1",
            "flaticon2-reload":"flaticon2-reload","flaticon2-placeholder":"flaticon2-placeholder","flaticon2-refresh":"flaticon2-refresh",
            "flaticon2-medical-records":"flaticon2-medical-records","flaticon2-rectangular":"flaticon2-rectangular",
            "flaticon2-medical-records-1":"flaticon2-medical-records-1","flaticon2-indent-dots":"flaticon2-indent-dots","flaticon2-search-1":"flaticon2-search-1",
            "flaticon2-edit":"flaticon2-edit","flaticon2-new-email":"flaticon2-new-email","flaticon2-calendar-4":"flaticon2-calendar-4",
            "flaticon2-add-circular-button":"flaticon2-add-circular-button","flaticon2-close-cross":"flaticon2-close-cross","flaticon2-attention":"flaticon2-attention",
            "flaticon2-information":"flaticon2-information","flaticon2-rocket-2":"flaticon2-rocket-2","flaticon2-maps":"flaticon2-maps","flaticon2-link":"flaticon2-link",
            "flaticon2-download-symbol":"flaticon2-download-symbol","flaticon2-power":"flaticon2-power","flaticon2-console":"flaticon2-console",
            "flaticon2-open-text-book":"flaticon2-open-text-book","flaticon2-download-2":"flaticon2-download-2","flaticon2-zig-zag-line-sign":"flaticon2-zig-zag-line-sign",
            "flaticon2-tools-and-utensils":"flaticon2-tools-and-utensils","flaticon2-crisp-icons":"flaticon2-crisp-icons","flaticon2-trash":"flaticon2-trash",
            "flaticon2-lock":"flaticon2-lock","flaticon2-bell-1":"flaticon2-bell-1","flaticon2-bell-alarm-symbol":"flaticon2-bell-alarm-symbol",
            "flaticon2-setup":"flaticon2-setup","flaticon2-menu-4":"flaticon2-menu-4","flaticon2-architecture-and-city":"flaticon2-architecture-and-city",
            "flaticon2-shelter":"flaticon2-shelter","flaticon2-add-1":"flaticon2-add-1","flaticon2-checkmark":"flaticon2-checkmark",
            "flaticon2-circular-arrow":"flaticon2-circular-arrow","flaticon2-user-outline-symbol":"flaticon2-user-outline-symbol","flaticon2-rhombus":"flaticon2-rhombus",
            "flaticon2-crisp-icons-1":"flaticon2-crisp-icons-1","flaticon2-soft-icons-1":"flaticon2-soft-icons-1","flaticon2-hexagonal":"flaticon2-hexagonal",
            "flaticon2-time":"flaticon2-time","flaticon2-contrast":"flaticon2-contrast","flaticon2-note":"flaticon2-note","flaticon2-telegram-logo":"flaticon2-telegram-logo",
            "flaticon2-hangouts-logo":"flaticon2-hangouts-logo","flaticon2-analytics-2":"flaticon2-analytics-2","flaticon2-wifi":"flaticon2-wifi",
            "flaticon2-protected":"flaticon2-protected","flaticon2-drop":"flaticon2-drop","flaticon2-mail-1":"flaticon2-mail-1",
            "flaticon2-delivery-truck":"flaticon2-delivery-truck","flaticon2-writing":"flaticon2-writing","flaticon2-calendar-5":"flaticon2-calendar-5",
            "flaticon2-protection":"flaticon2-protection","flaticon2-calendar-6":"flaticon2-calendar-6","flaticon2-calendar-7":"flaticon2-calendar-7",
            "flaticon2-calendar-8":"flaticon2-calendar-8","flaticon2-bell-2":"flaticon2-bell-2","flaticon2-hourglass-1":"flaticon2-hourglass-1",
            "flaticon2-next":"flaticon2-next","flaticon2-chat-2":"flaticon2-chat-2","flaticon2-correct":"flaticon2-correct","flaticon2-right-arrow":"flaticon2-right-arrow",
            "flaticon2-down-arrow":"flaticon2-down-arrow","flaticon2-photo-camera":"flaticon2-photo-camera","flaticon2-fast-next":"flaticon2-fast-next",
            "flaticon2-fast-back":"flaticon2-fast-back","flaticon2-down":"flaticon2-down","flaticon2-back":"flaticon2-back","flaticon2-up":"flaticon2-up",
            "flaticon2-arrow-down":"flaticon2-arrow-down","flaticon2-arrow-up":"flaticon2-arrow-up","flaticon2-accept":"flaticon2-accept","flaticon2-sort":"flaticon2-sort",
            "flaticon2-arrow":"flaticon2-arrow","flaticon2-back-1":"flaticon2-back-1","flaticon2-add-square":"flaticon2-add-square",
            "flaticon2-quotation-mark":"flaticon2-quotation-mark","flaticon2-clip-symbol":"flaticon2-clip-symbol","flaticon2-check-mark":"flaticon2-check-mark",
            "flaticon2-folder":"flaticon2-folder","flaticon2-cancel-music":"flaticon2-cancel-music","flaticon2-cross":"flaticon2-cross","flaticon2-pen":"flaticon2-pen",
            "flaticon2-email":"flaticon2-email","flaticon2-graph-2":"flaticon2-graph-2","flaticon2-open-box":"flaticon2-open-box",
            "flaticon2-files-and-folders":"flaticon2-files-and-folders","flaticon2-ui":"flaticon2-ui","flaticon2-sheet":"flaticon2-sheet",
            "flaticon2-dashboard":"flaticon2-dashboard","flaticon2-user-1":"flaticon2-user-1","flaticon2-group":"flaticon2-group"}';
        $flaticon = json_decode($json);
        return $flaticon;
    }
}

if (!function_exists('flat')) {
    function flat()
    {
        $arr = '{"0":"flaticon-email-black-circular-button","1":"flaticon-map","2":"flaticon-alert-off","3":"flaticon-alert","4":"flaticon-computer","5":"flaticon-responsive","6":"flaticon-presentation","7":"flaticon-arrows","8":"flaticon-rocket","9":"flaticon-reply","10":"flaticon-gift","11":"flaticon-confetti","12":"flaticon-piggy-bank","13":"flaticon-support","14":"flaticon-delete","15":"flaticon-eye","16":"flaticon-multimedia","17":"flaticon-whatsapp","18":"flaticon-multimedia-2","19":"flaticon-email","20":"flaticon-presentation-1","21":"flaticon-trophy","22":"flaticon-psd","23":"flaticon-layer","24":"flaticon-doc","25":"flaticon-file","26":"flaticon-network","27":"flaticon-bus-stop","28":"flaticon-globe","29":"flaticon-upload","30":"flaticon-squares","31":"flaticon-technology","32":"flaticon-up-arrow","33":"flaticon-browser","34":"flaticon-speech-bubble","35":"flaticon-coins","36":"flaticon-open-box","37":"flaticon-speech-bubble-1","38":"flaticon-attachment","39":"flaticon-photo-camera","40":"flaticon-skype-logo","41":"flaticon-linkedin-logo","42":"flaticon-twitter-logo","43":"flaticon-facebook-letter-logo","44":"flaticon-calendar-with-a-clock-time-tools","45":"flaticon-youtube","46":"flaticon-add-circular-button","47":"flaticon-more-v2","48":"flaticon-search","49":"flaticon-search-magnifier-interface-symbol","50":"flaticon-questions-circular-button","51":"flaticon-refresh","52":"flaticon-logout","53":"flaticon-event-calendar-symbol","54":"flaticon-laptop","55":"flaticon-tool","56":"flaticon-graphic","57":"flaticon-symbol","58":"flaticon-graphic-1","59":"flaticon-clock","60":"flaticon-squares-1","61":"flaticon-black","62":"flaticon-book","63":"flaticon-cogwheel","64":"flaticon-exclamation","65":"flaticon-add-label-button","66":"flaticon-delete-1","67":"flaticon-interface","68":"flaticon-more","69":"flaticon-warning-sign","70":"flaticon-calendar","71":"flaticon-instagram-logo","72":"flaticon-linkedin","73":"flaticon-facebook-logo-button","74":"flaticon-twitter-logo-button","75":"flaticon-cancel","76":"flaticon-exclamation-square","77":"flaticon-buildings","78":"flaticon-danger","79":"flaticon-technology-1","80":"flaticon-letter-g","81":"flaticon-interface-1","82":"flaticon-circle","83":"flaticon-pin","84":"flaticon-close","85":"flaticon-clock-1","86":"flaticon-apps","87":"flaticon-user","88":"flaticon-menu-button","89":"flaticon-settings","90":"flaticon-home","91":"flaticon-clock-2","92":"flaticon-lifebuoy","93":"flaticon-cogwheel-1","94":"flaticon-paper-plane","95":"flaticon-statistics","96":"flaticon-diagram","97":"flaticon-line-graph","98":"flaticon-customer","99":"flaticon-visible","100":"flaticon-shopping-basket","101":"flaticon-price-tag","102":"flaticon-businesswoman","103":"flaticon-medal","104":"flaticon-like","105":"flaticon-edit","106":"flaticon-avatar","107":"flaticon-download","108":"flaticon-home-1","109":"flaticon-mail","110":"flaticon-mail-1","111":"flaticon-warning","112":"flaticon-cart","113":"flaticon-bag","114":"flaticon-pie-chart","115":"flaticon-graph","116":"flaticon-interface-2","117":"flaticon-chat","118":"flaticon-envelope","119":"flaticon-chat-1","120":"flaticon-interface-3","121":"flaticon-background","122":"flaticon-file-1","123":"flaticon-interface-4","124":"flaticon-multimedia-3","125":"flaticon-list","126":"flaticon-time","127":"flaticon-profile","128":"flaticon-imac","129":"flaticon-medical","130":"flaticon-music","131":"flaticon-plus","132":"flaticon-exclamation-1","133":"flaticon-info","134":"flaticon-menu-1","135":"flaticon-menu-2","136":"flaticon-share","137":"flaticon-interface-5","138":"flaticon-signs","139":"flaticon-tabs","140":"flaticon-multimedia-4","141":"flaticon-upload-1","142":"flaticon-web","143":"flaticon-placeholder","144":"flaticon-placeholder-1","145":"flaticon-layers","146":"flaticon-interface-6","147":"flaticon-interface-7","148":"flaticon-interface-8","149":"flaticon-tool-1","150":"flaticon-settings-1","151":"flaticon-alarm","152":"flaticon-search-1","153":"flaticon-time-1","154":"flaticon-stopwatch","155":"flaticon-folder","156":"flaticon-folder-1","157":"flaticon-folder-2","158":"flaticon-folder-3","159":"flaticon-file-2","160":"flaticon-list-1","161":"flaticon-list-2","162":"flaticon-calendar-1","163":"flaticon-time-2","164":"flaticon-interface-9","165":"flaticon-app","166":"flaticon-suitcase","167":"flaticon-grid-menu-v2","168":"flaticon-more-v6","169":"flaticon-more-v5","170":"flaticon-add","171":"flaticon-multimedia-5","172":"flaticon-more-v4","173":"flaticon-placeholder-2","174":"flaticon-map-location","175":"flaticon-users","176":"flaticon-profile-1","177":"flaticon-lock","178":"flaticon-sound","179":"flaticon-star","180":"flaticon-placeholder-3","181":"flaticon-bell","182":"flaticon-paper-plane-1","183":"flaticon-users-1","184":"flaticon-more-1","185":"flaticon-up-arrow-1","186":"flaticon-grid-menu","187":"flaticon-alarm-1","188":"flaticon-earth-globe","189":"flaticon-alert-1","190":"flaticon-internet","191":"flaticon-user-ok","192":"flaticon-user-add","193":"flaticon-user-settings","194":"flaticon-truck","195":"flaticon-analytics","196":"flaticon-notes","197":"flaticon-tea-cup","198":"flaticon-exclamation-2","199":"flaticon-technology-2","200":"flaticon-location","201":"flaticon-edit-1","202":"flaticon-home-2","203":"flaticon-dashboard","204":"flaticon-information","205":"flaticon-light","206":"flaticon-car","207":"flaticon-business","208":"flaticon-squares-2","209":"flaticon-signs-1","210":"flaticon-mark","211":"flaticon-squares-3","212":"flaticon-comment","213":"flaticon-shapes","214":"flaticon-clipboard","215":"flaticon-squares-4","216":"flaticon-delete-2","217":"flaticon-bell-1","218":"flaticon-list-3","219":"flaticon-infinity","220":"flaticon-chat-2","221":"flaticon-calendar-2","222":"flaticon-signs-2","223":"flaticon-time-3","224":"flaticon-calendar-3","225":"flaticon-interface-10","226":"flaticon-interface-11","227":"flaticon-folder-4","228":"flaticon-alert-2","229":"flaticon-cogwheel-2","230":"flaticon-graphic-2","231":"flaticon-rotate","232":"flaticon-feed","233":"flaticon-safe-shield-protection","234":"flaticon-security","235":"flaticon-download-1","236":"flaticon-pie-chart-1","237":"flaticon-notepad","238":"flaticon2-notification","239":"flaticon2-settings","240":"flaticon2-search","241":"flaticon2-delete","242":"flaticon2-psd","243":"flaticon2-list","244":"flaticon2-box","245":"flaticon2-download","246":"flaticon2-shield","247":"flaticon2-paperplane","248":"flaticon2-avatar","249":"flaticon2-bell","250":"flaticon2-fax","251":"flaticon2-chart2","252":"flaticon2-supermarket","253":"flaticon2-phone","254":"flaticon2-envelope","255":"flaticon2-pin","256":"flaticon2-chat","257":"flaticon2-chart","258":"flaticon2-infographic","259":"flaticon2-grids","260":"flaticon2-menu","261":"flaticon2-plus","262":"flaticon2-list-1","263":"flaticon2-talk","264":"flaticon2-file","265":"flaticon2-user","266":"flaticon2-line-chart","267":"flaticon2-percentage","268":"flaticon2-menu-1","269":"flaticon2-paper-plane","270":"flaticon2-menu-2","271":"flaticon2-shopping-cart","272":"flaticon2-pie-chart","273":"flaticon2-box-1","274":"flaticon2-map","275":"flaticon2-favourite","276":"flaticon2-checking","277":"flaticon2-safe","278":"flaticon2-heart-rate-monitor","279":"flaticon2-layers","280":"flaticon2-delivery-package","281":"flaticon2-sms","282":"flaticon2-image-file","283":"flaticon2-plus-1","284":"flaticon2-send","285":"flaticon2-graphic-design","286":"flaticon2-cup","287":"flaticon2-website","288":"flaticon2-gift","289":"flaticon2-chronometer","290":"flaticon2-bar-chart","291":"flaticon2-browser","292":"flaticon2-digital-marketing","293":"flaticon2-calendar","294":"flaticon2-calendar-1","295":"flaticon2-rocket","296":"flaticon2-analytics","297":"flaticon2-pie-chart-1","298":"flaticon2-pie-chart-2","299":"flaticon2-analytics-1","300":"flaticon2-google-drive-file","301":"flaticon2-pie-chart-3","302":"flaticon2-poll-symbol","303":"flaticon2-gear","304":"flaticon2-magnifier-tool","305":"flaticon2-add","306":"flaticon2-cube","307":"flaticon2-gift-1","308":"flaticon2-list-2","309":"flaticon2-shopping-cart-1","310":"flaticon2-calendar-2","311":"flaticon2-laptop","312":"flaticon2-cube-1","313":"flaticon2-layers-1","314":"flaticon2-chat-1","315":"flaticon2-copy","316":"flaticon2-paper","317":"flaticon2-hospital","318":"flaticon2-calendar-3","319":"flaticon2-speaker","320":"flaticon2-pie-chart-4","321":"flaticon2-schedule","322":"flaticon2-expand","323":"flaticon2-menu-3","324":"flaticon2-download-1","325":"flaticon2-help","326":"flaticon2-list-3","327":"flaticon2-notepad","328":"flaticon2-graph","329":"flaticon2-browser-1","330":"flaticon2-photograph","331":"flaticon2-browser-2","332":"flaticon2-hourglass","333":"flaticon2-mail","334":"flaticon2-cardiogram","335":"flaticon2-document","336":"flaticon2-contract","337":"flaticon2-graph-1","338":"flaticon2-graphic","339":"flaticon2-position","340":"flaticon2-soft-icons","341":"flaticon2-circle-vol-2","342":"flaticon2-rocket-1","343":"flaticon2-lorry","344":"flaticon2-cd","345":"flaticon2-file-1","346":"flaticon2-reload","347":"flaticon2-placeholder","348":"flaticon2-refresh","349":"flaticon2-medical-records","350":"flaticon2-rectangular","351":"flaticon2-medical-records-1","352":"flaticon2-indent-dots","353":"flaticon2-search-1","354":"flaticon2-edit","355":"flaticon2-new-email","356":"flaticon2-calendar-4","357":"flaticon2-add-circular-button","358":"flaticon2-close-cross","359":"flaticon2-attention","360":"flaticon2-information","361":"flaticon2-rocket-2","362":"flaticon2-maps","363":"flaticon2-link","364":"flaticon2-download-symbol","365":"flaticon2-power","366":"flaticon2-console","367":"flaticon2-open-text-book","368":"flaticon2-download-2","369":"flaticon2-zig-zag-line-sign","370":"flaticon2-tools-and-utensils","371":"flaticon2-crisp-icons","372":"flaticon2-trash","373":"flaticon2-lock","374":"flaticon2-bell-1","375":"flaticon2-bell-alarm-symbol","376":"flaticon2-setup","377":"flaticon2-menu-4","378":"flaticon2-architecture-and-city","379":"flaticon2-shelter","380":"flaticon2-add-1","381":"flaticon2-checkmark","382":"flaticon2-circular-arrow","383":"flaticon2-user-outline-symbol","384":"flaticon2-rhombus","385":"flaticon2-crisp-icons-1","386":"flaticon2-soft-icons-1","387":"flaticon2-hexagonal","388":"flaticon2-time","389":"flaticon2-contrast","390":"flaticon2-note","391":"flaticon2-telegram-logo","392":"flaticon2-hangouts-logo","393":"flaticon2-analytics-2","394":"flaticon2-wifi","395":"flaticon2-protected","396":"flaticon2-drop","397":"flaticon2-mail-1","398":"flaticon2-delivery-truck","399":"flaticon2-writing","400":"flaticon2-calendar-5","401":"flaticon2-protection","402":"flaticon2-calendar-6","403":"flaticon2-calendar-7","404":"flaticon2-calendar-8","405":"flaticon2-bell-2","406":"flaticon2-hourglass-1","407":"flaticon2-next","408":"flaticon2-chat-2","409":"flaticon2-correct","410":"flaticon2-right-arrow","411":"flaticon2-down-arrow","412":"flaticon2-photo-camera","413":"flaticon2-fast-next","414":"flaticon2-fast-back","415":"flaticon2-down","416":"flaticon2-back","417":"flaticon2-up","418":"flaticon2-arrow-down","419":"flaticon2-arrow-up","420":"flaticon2-accept","421":"flaticon2-sort","422":"flaticon2-arrow","423":"flaticon2-back-1","424":"flaticon2-add-square","425":"flaticon2-quotation-mark","426":"flaticon2-clip-symbol","427":"flaticon2-check-mark","428":"flaticon2-folder","429":"flaticon2-cancel-music","430":"flaticon2-cross","431":"flaticon2-pen","432":"flaticon2-email","433":"flaticon2-graph-2","434":"flaticon2-open-box","435":"flaticon2-files-and-folders","436":"flaticon2-ui","437":"flaticon2-sheet","438":"flaticon2-dashboard","439":"flaticon2-user-1","440":"flaticon2-group"}';
        $flaticon = json_decode($arr);
        return $flaticon;
    }
}

if (!function_exists('generate_menu')) {
    function generate_menu()
    {
        $nav = \Illuminate\Support\Facades\DB::select("
                   select * from master_menu 
                   where menu_deleted_at IS NULL 
                   order by menu_order asc ");
        if (sizeof($nav) > 0) {
            $html = '<ol class="dd-list">';
            foreach ($nav as $page) {
                $cek_submenu = \Illuminate\Support\Facades\DB::select('
                        select menu_id from master_menu 
                        where menu_deleted_at IS NULL 
                        AND menu_parentid=' . $page->menu_id);
                $submenu = '';
                if (sizeof($cek_submenu) > 0) {
                    $submenu = '
                                    <button
                                        mydata-url="' . route('menu.delete.bulk', $page->menu_id) . '"
                                        mydata-isdelete=""
                                        mydata-name="' . $page->menu_name . '"
                                        mydata-id="' . $page->menu_id . '[]' . $page->menu_id . '"
                                        type="button" class="btn btn-sm btn-danger deletemenu">
                                        <span class="fa fa-trash" aria-hidden="true"></span> 
                                        Hapus bersama submenu
                                     </button>';
                }
                if ($page->menu_parentid == 0 || $page->menu_parentid == null) {
                    $aksi = '
                                <div>
                                <a href="' . route('menu.edit', $page->menu_id) . '" class="ajaxify">
                                    <button type="button" class="btn btn-sm btn-warning">
                                        <span class="fa fa-edit" aria-hidden="true"></span> 
                                            Edit
                                        </button>
                                    </a>
                                <button
                                    mydata-url="' . route('menu.delete', $page->menu_id) . '"
                                    mydata-isdelete=""
                                    mydata-name="' . $page->menu_name . '"
                                    mydata-id="' . $page->menu_id . '[]' . $page->menu_id . '"
                                    mydata-menu_id="' . $page->menu_id . '"
                                    type="button" class="btn btn-sm btn-danger deletemenu">
                                    <span class="fa fa-trash" aria-hidden="true"></span> 
                                    Hapus
                                 </button>
                                ' . $submenu . '
                                </div>
                                ';
                    $html .= '<li class="dd-item" data-id="' . $page->menu_id . '">';
                    $html .= '<div class="dd-handle">' . $page->menu_name . '</div>' . $aksi;
                    $get_child = \Illuminate\Support\Facades\DB::select("
                                        select * from master_menu 
                                        where menu_deleted_at IS NULL  
                                        AND menu_parentid=" . $page->menu_id . " 
                                        order by menu_order asc");
                    $html .= generatechild($get_child);
                    $html .= '</li>';
                }
            }
            $html .= '</ol>';
            echo $html;
        }
    }
}

if (!function_exists('generatechild')) {
    function generatechild($nav)
    {
        if (sizeof($nav) > 0) {
            $html = '<ol class="dd-list">';
            foreach ($nav as $page) {
                if ($page->menu_parentid != 0 || $page->menu_parentid != null) {
                    $cek_submenu = \Illuminate\Support\Facades\DB::select('
                                        select menu_id from master_menu 
                                        where menu_deleted_at IS NULL 
                                        AND menu_parentid=' . $page->menu_id);
                    $submenu = '';
                    if (sizeof($cek_submenu) > 0) {
                        $submenu = '
                                    <button
                                        mydata-url="' . route('menu.delete.bulk', $page->menu_id) . '"
                                        mydata-isdelete=""
                                        mydata-name="' . $page->menu_name . '"
                                        mydata-id="' . $page->menu_id . '[]' . $page->menu_id . '"
                                        type="button" class="btn btn-sm btn-danger deletemenu">
                                        <span class="fa fa-trash" aria-hidden="true"></span> 
                                            Hapus bersama submenu
                                    </button>';
                    }
                    $aksi = '
                                <div>
                                <a href="' . route('menu.edit', $page->menu_id) . '" class="ajaxify">
                                    <button type="button" class="btn btn-sm btn-warning"><span class="fa fa-edit" aria-hidden="true"></span> 
                                        Edit
                                    </button>
                                 </a>
                                <button
                                    mydata-url="' . route('menu.delete', $page->menu_id) . '"
                                    mydata-isdelete=""
                                    mydata-name="' . $page->menu_name . '"
                                    mydata-id="' . $page->menu_id . '[]' . $page->menu_id . '"
                                    type="button" class="btn btn-sm btn-danger deletemenu">
                                    <span class="fa fa-trash" aria-hidden="true"></span> 
                                    Hapus
                                 </button>
                                ' . $submenu . '
                                </div>
                                ';
                    $html .= '<li class="dd-item" data-id="' . $page->menu_id . '">';
                    $html .= '<div class="dd-handle">' . $page->menu_name . '</div>' . $aksi;
                    $get_child = \Illuminate\Support\Facades\DB::select("
                                      select * from master_menu 
                                      where menu_deleted_at IS NULL 
                                      AND menu_parentid=" . $page->menu_id . " 
                                      order by menu_order asc");
                    $html .= generatechild($get_child);
                    $html .= '</li>';
                }
            }
            $html .= '</ol>';
            return $html;
        }
    }
}

if (!function_exists('nice_date')) {
    /**
     * Turns many "reasonably-date-like" strings into something
     * that is actually useful. This only works for dates after unix epoch.
     *
     * @param	string	The terribly formatted date-like string
     * @param	string	Date format to return (same as php date function)
     * @return	string
     */
    function nice_date($bad_date = '', $format = FALSE)
    {
        if (empty($bad_date)) {
            return 'Unknown';
        } elseif (empty($format)) {
            $format = 'U';
        }

        // Date like: YYYYMM
        if (preg_match('/^\d{6}$/i', $bad_date)) {
            if (in_array(substr($bad_date, 0, 2), array('19', '20'))) {
                $year  = substr($bad_date, 0, 4);
                $month = substr($bad_date, 4, 2);
            } else {
                $month  = substr($bad_date, 0, 2);
                $year   = substr($bad_date, 2, 4);
            }

            return date($format, strtotime($year . '-' . $month . '-01'));
        }

        // Date Like: YYYYMMDD
        if (preg_match('/^(\d{2})\d{2}(\d{4})$/i', $bad_date, $matches)) {
            return date($format, strtotime($matches[1] . '/01/' . $matches[2]));
        }

        // Date Like: MM-DD-YYYY __or__ M-D-YYYY (or anything in between)
        if (preg_match('/^(\d{1,2})-(\d{1,2})-(\d{4})$/i', $bad_date, $matches)) {
            return date($format, strtotime($matches[3] . '-' . $matches[1] . '-' . $matches[2]));
        }

        // Any other kind of string, when converted into UNIX time,
        // produces "0 seconds after epoc..." is probably bad...
        // return "Invalid Date".
        if (date('U', strtotime($bad_date)) === '0') {
            return 'Invalid Date';
        }

        // It's probably a valid-ish date format already
        return date($format, strtotime($bad_date));
    }
}


if (!function_exists("date_format_")) {
    function date_format_($string, $format = null)
    {
        if (empty($format)) $format = date('Y-m-d');
        if (!empty($format)) $format = date($format);
        $time = strtotime($string);
        return date($format, $time);
    }
}

if (!function_exists('app_date_value')) {
    function app_date_value($date, $format = 'd/m/Y', $from = '')
    {
        $result   = null;
        if ($date != "") {
            $result = ($from == '')  ? nice_date($date, $format) : app_date_format($date, $format, $from);
        }

        return $result;
    }
}

if (!function_exists('app_value_numeric')) {
    function app_value_numeric($str, $decimal = 0, $prefix = "", $suffix = "")
    {
        $str      = is_numeric($str) ? $str : 0;
        $string   = number_format($str, $decimal, ",", ".");

        return $prefix . $string . $suffix;
    }
}

if (!function_exists('app_generate_nik')) {
    function app_generate_nik($data = null, $length = 5)
    {
        $datas['karyawan_tipe'] = @$data != "" ? $data : "LEPAS";
        $_tipe  = strtoupper(@$datas['karyawan_tipe']) == "TETAP" ? "GP" : "GPL"; // old backup script
        // $_tipe  = get_perusahaan_prefix(@$data['karyawan_tipe']); // new "mengambil kode karyawan / pelanggan sesuai perusahaan kode";
        // $where['where']  = "karyawan_tipe IN ('TETAP','LEPAS')";
        // $order = [
        //     [
        //         'field'     => 'karyawan_id',
        //         'direction' => 'DESC'
        //     ],
        // ];
        // $_seq = _CI()->m_general->get_data('row','duaagung_karyawan', "MAX(RIGHT(karyawan_nik,{$length})) as nik", ['where' => ['karyawan_tipe' => @$data['karyawan_tipe']]]);
        // $_seq = _CI()->m_general->get_data('row', 'duaagung_karyawan', "RIGHT(karyawan_nik,{$length}) as nik", $where, $order, null, 1);
        // $_seq = DB::table('master_karyawan')
        // ->select('RIGHT(karyawan_nik,{$length}) as nik')
        // ->whereIn('karyawan_tipe',['"TETAP"','"LEPAS"'])
        // ->orderBy("karyawan_id", 'DESC')
        // ->limit(1)
        // ->first();
        $_seq = DB::select('select RIGHT(karyawan_nik,5) as nik from karyawan where karyawan_tipe in ("TETAP", "LEPAS") order by karyawan_id desc limit 1');
        // trace($_seq);
        $seq  = intval($_seq[0]->nik) + 1;
        $nik  = $_tipe;
        $nik  .= @$data['karyawan_tgl_masuk'] != "" ? nice_date(@$data['karyawan_tgl_masuk'], 'ym') : date('ym');
        // $nik  .= @$data['karyawan_tgllahir'] != "" ? nice_date(@$data['karyawan_tgllahir'], 'y') : '00';
        // $nik  .= @$data['karyawan_jk'] != "" ? @$data['karyawan_jk'] : '8';
        $nik  .= substr(str_repeat("0", $length) . $seq, ($length * -1));

        return $nik;
    }
}

if (!function_exists('app_generate_unik_no')) {
    function app_generate_unik_no($tbl, $kolom, $prefix = "", $middle = "", $where = null, $length = 4)
    {
        $new_where = "";
        if (!empty($where['custom'])) $new_where = " WHERE " . $where['custom'];
        $query = 'select MAX(RIGHT(' . $kolom . ',' . $length . ')) as unik from ' . $tbl . ' ' . $new_where;

        $_seq = DB::select($query);
        $seq  = intval($_seq[0]->unik) + 1;
        $generate  = $prefix;
        $generate  .= $middle;

        $generate  .= substr(str_repeat("000", $length) . $seq, ($length * -1));

        return $generate;
    }
}

if (!function_exists("Ymd")) {
    function Ymd($arg)
    {
        return Carbon\Carbon::createFromFormat("!d-m-Y", $arg)->format("Y-m-d");
    }
}

if (!function_exists("digit")) {
    function digit($value, $length = 4)
    {
        return substr(str_repeat("000", $length) . $value, ($length * -1));
    }
}

if (!function_exists("dmY")) {
    function dmY($arg)
    {
        return date("d-m-Y", strtotime($arg));
    }
}

if (!function_exists("bold")) {
    function bold($arg)
    {
        return "<b>" . $arg . "</b>";
    }
}


if (!function_exists("br")) {
    function br($range = 1)
    {
        $br = "";
        for ($i = 0; $i < $range; $i++) {
            $br .= "<br>";
        }
        return $br;
    }
}

if (!function_exists("badge_success")) {
    function badge_success($arg)
    {
        return '<span class="kt-badge kt-badge--success kt-badge--inline">' . $arg . '</span>';
    }
}

if (!function_exists("badge_info")) {
    function badge_info($arg)
    {
        return '<span class="kt-badge kt-badge--info kt-badge--inline">' . $arg . '</span>';
    }
}

    if (!function_exists("user_id")) {
        function user_id()
        {
            return \Illuminate\Support\Facades\Auth::user()->karyawan_id;
        }
    }

if (!function_exists("build_where")) {
    function build_where($query, $patern, $request)
    {
        foreach ($patern as $k => $value) {
            foreach ($value as $v => $item) {
            	// dump($item);
                if (is_numeric($v)) {
                    $req_value = trim($request->$item);
                    if ($request->filled($item)) {
                        if ($k == "like") {
                            $query->where($item, "like", "%{$req_value}%");
                        } else if ($k == "=") {
                            $query->where($item, "=", "{$req_value}");
                        }
                    }
                } else {
                    if ($k == "like") {
                        if ($request->filled($v)) {
                            $_value = trim($request->input($v));
                            if (strpos($item, '||') !== false) {
                                $column = explode("||", $item);
                                $query->where(function ($q) use ($column, $_value) {
                                    foreach ($column as $col) {
                                        $q->orWhere($col, "like", "%{$_value}%");
                                    }
                                });
                            } else if (strpos($item, '&&') !== false) {
                                $column = explode("&&", $item);

                                $query->where(function ($q) use ($column, $_value) {
                                    foreach ($column as $col) {
                                        $q->where($col, "like", "%{$_value}%");
                                    }
                                });
                            } else {
                                $query->where($item, "like", "%{$_value}%");
                            }
                        }
                    } else if ($k == "=") {
                        if ($request->filled($v)) {
                            $_value = $request->input($v);
                            if (strpos($item, '||') !== false) {
                                $column = explode("||", $item);

                                $query->where(function ($q) use ($column, $_value) {
                                    foreach ($column as $col) {
                                        $q->orWhere($col, "like", $_value);
                                    }
                                });
                            } else if (strpos($item, '&&') !== false) {
                                $column = explode("&&", $item);

                                $query->where(function ($q) use ($column, $_value) {
                                    foreach ($column as $col) {
                                        $q->where($col, "=", $_value);
                                    }
                                });
                            } else {
                                $query->where($item, "=", $_value);
                            }
                        }
                    } else if ($k == "between") {
                        if ($request->filled($item["start"]) && $request->filled($item["end"])) {

                            $start = date('Y-m-d', strtotime($request->input($item["start"])));
                            $end = date('Y-m-d', strtotime($request->input($item["end"])));
                            $tgl = [
                                "column" =>  $v,
                                "start" => $start,
                                "end" => $end
                            ];

                            $query->where(function ($q) use ($tgl) {
                                $q->where(DB::raw("date_format(" . $tgl["column"] . ", '%Y-%m-%d' )"), ">=", $tgl["start"]);
                                $q->where(DB::raw("date_format(" . $tgl["column"] . ", '%Y-%m-%d' )"), "<=", $tgl["end"]);
                            });
                        }
                    } else if ($k == "between_2") {
                        if ($request->filled($v)) {

                            $value = date('Y-m-d', strtotime($request->input($v)));
                            $start = $item["start"];
                            $end = $item["end"];

                            $tgl = [
                                "value" =>  $value,
                                "start" => $start,
                                "end" => $end
                            ];

                            $query->where(function ($q) use ($tgl) {
                                $q->where($tgl["start"], "<=", $tgl["value"]);
                                $q->where($tgl["end"], ">=", $tgl["value"]);
                            });
                        }
                    }
                }
            }
        }

        return $query;
    }
}


if (!function_exists("select_dtb")) {
    function select_dtb(...$args)
    {
        $data = [];
        if (is_array($args[0])) {
            foreach ($args[0] as $key => $value) {
                $data[$value] = [
                    "label" => $value,
                    "desc" => $value,
                ];
            }
        } else {
            foreach ($args as $item) {
                $data[$item] = [
                    "label" => $item,
                    "desc" => $item,
                ];
            }
        }

        return $data;
    }
}

if (!function_exists("error_response")) {
    function error_response(...$args)
    {

        $res = [];

        if (is_array($args[0])) {
            foreach ($args[0] as $key => $value) {
                $res["data-" . $key][] = $value;
            }
        } else {

            foreach ($args as $key => $value) {
                $res["data-" . $key][] = $value;
            }
            // $res = $args;
        }

        return response()->json([
            "errors" => $res
        ], 422);
    }
}

function _terbilang($x)
{
    $x = abs($x);
    $angka = array(
        "", "Satu", "Dua", "Tiga", "Empat", "Lima",
        "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"
    );
    $temp = "";
    if ($x < 12) {
        $temp = " " . $angka[$x];
    } else if ($x < 20) {
        $temp = _terbilang($x - 10) . " Belas";
    } else if ($x < 100) {
        $temp = _terbilang($x / 10) . " Puluh" . _terbilang($x % 10);
    } else if ($x < 200) {
        $temp = " Seratus" . _terbilang($x - 100);
    } else if ($x < 1000) {
        $temp = _terbilang($x / 100) . " Ratus" . _terbilang($x % 100);
    } else if ($x < 2000) {
        $temp = " Seribu" . _terbilang($x - 1000);
    } else if ($x < 1000000) {
        $temp = _terbilang($x / 1000) . " Ribu" . _terbilang($x % 1000);
    } else if ($x < 1000000000) {
        $temp = _terbilang($x / 1000000) . " Juta" . _terbilang($x % 1000000);
    } else if ($x < 1000000000000) {
        $temp = _terbilang($x / 1000000000) . " Milyar" . _terbilang(fmod($x, 1000000000));
    } else if ($x < 1000000000000000) {
        $temp = _terbilang($x / 1000000000000) . " Trilyun" . _terbilang(fmod($x, 1000000000000));
    }
    return $temp;
}

// if (!function_exists("is_admin")) {
//     function is_admin()
//     {
//         $user   = Auth::user();
//         if (in_array(@$user->karyawan_role_id, ['1'])) {
//             return true;
//         }

//         if (in_array(@$user->role_name, ['ADMINISTRATOR SATELIT'])) {
//             return true;
//         }

//         return false;
//     }
// }

function get_kantor_pusat()
{
    \Illuminate\Support\Facades\DB::enableQueryLog();
    $kantor = collect(\Illuminate\Support\Facades\DB::select("
			SELECT 
			a.`kantor_id`,
			a.`kantor_nama`
			FROM master_kantor a
			WHERE a.`kantor_tipe`='PUSAT' AND a.`kantor_is_delete`='0'
		"))->first();
    // dd(\Illuminate\Support\Facades\DB::getQueryLog());

    return [
        'id' => $kantor->kantor_id,
        'name' => $kantor->kantor_nama
    ];
}

function terbilang($x, $style = 4)
{
    if ($x < 0) {
        $hasil = "minus " . trim(_terbilang($x));
    } else {
        $hasil = trim(_terbilang($x));
    }
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }
    return $hasil;
}

if (!function_exists("array_sum_key")) {
    function array_sum_key($data, $key)
    {
        $data = array_sum(array_map(function ($item) use ($key) {
            return $item[$key];
        }, $data));

        return $data;
    }
}


function get_current_user_id()
{
    $session    = Auth::user();
    return @$session->karyawan_id;
}

if (!function_exists("Ymdhis")) {
    function Ymdhis()
    {
        return date("Y-m-d h:i:s");
    }
}

function getSql($model)
{
    $replace = function ($sql, $bindings) {
        $needle = '?';
        foreach ($bindings as $replace) {
            $pos = strpos($sql, $needle);
            if ($pos !== false) {
                if (gettype($replace) === "string") {
                    $replace = ' "' . addslashes($replace) . '" ';
                }
                $sql = substr_replace($sql, $replace, $pos, strlen($needle));
            }
        }
        return $sql;
    };
    $sql = $replace($model->toSql(), $model->getBindings());
    return $sql;
}

function find_between(string $string, string $start, string $end, bool $greedy = false)
{
    $start = preg_quote($start, '/');
    $end   = preg_quote($end, '/');

    $format = '/(%s)(.*';
    if (!$greedy) $format .= '?';
    $format .= ')(%s)/';

    $pattern = sprintf($format, $start, $end);
    preg_match($pattern, $string, $matches);

    return $matches[2];
}

function count_dtb_group($query)
{
    $q = getSql($query);
    $check = substr_count($q, "select");
    $pre = "select count(*) as count from (";
    $post = ") as tmp";

    if ($check == 1) {
        $replace = find_between($q, "select", "from");
        $q_new = str_replace($replace, " count(*) ", $q);

        $q_fix = $pre . $q_new . $post;
    } else {
        if ($check == 2) {
            $position_form = strripos($q, "from");
            $query_string = substr($q, $position_form, strlen($q));
            $q_new = "select count(*) " . $query_string;

            $q_fix = $pre . $q_new . $post;
        }
    }

    // dd($q_fix);
    $data = DB::select($q_fix);
    return $data[0]->count;
}

if (!function_exists('app_master_bulan')) {
    function app_master_bulan($index_satu = null)
    {
        $bulan =  [
            '' => 'PILIH BULAN',
            '1' => 'JANUARI',
            '2' => 'FEBRUARI',
            '3' => 'MARET',
            '4' => 'APRIL',
            '5' => 'MEI',
            '6' => 'JUNI',
            '7' => 'JULI',
            '8' => 'AGUSTUS',
            '9' => 'SEPTEMBER',
            '10' => 'OKTOBER',
            '11' => 'NOVEMBER',
            '12' => 'DESEMBER',
        ];

        if (!is_null(@$index_satu)) {
            return $bulan[$index_satu];
        } else {
            return $bulan;
        }
    }
}



if ( !function_exists('time_elapsed_string') )
{
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'tahun',
            'm' => 'bulan',
            'w' => 'minggu',
            'd' => 'hari',
            'h' => 'jam',
            'i' => 'menit',
            's' => 'detik',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' lalu' : 'Baru saja';
    }
}

if (!function_exists("pengurangan_biaya_ambil_sendiri")) {
    function pengurangan_biaya_ambil_sendiri($order_id , $nominal = 0)
    {

    //     $CI = _CI();
        $query = "SELECT 
            IFNULL(SUM(b.`pengirimandetail_qty` * ( IFNULL(null ,0) + IFNULL(e.`hargapengirimanorderdetail_nominal`,0)) ),0) AS total
          FROM trx_pengiriman a
              LEFT JOIN trx_pengiriman_detail b ON a.`pengiriman_id`=b.`pengirimandetail_pengiriman_id`
              LEFT JOIN trx_order_detail c ON b.`pengirimandetail_orderdetail_id`=c.`orderdetail_id`
              LEFT JOIN trx_order d ON a.`pengiriman_order_id`=d.`order_id` AND d.`order_is_delete`='0' AND d.`order_deleted_at` IS NULL
              LEFT JOIN master_harga_pengiriman_order f on f.hargapengirimanorder_order_id = order_id
              LEFT JOIN master_harga_pengiriman_order_detail e ON f.`hargapengirimanorder_id` = e.`hargapengirimanorderdetail_hargapengirimanorder_id` AND c.`orderdetail_produk_id`= e.`hargapengirimanorderdetail_produk_id`
          WHERE a.`pengiriman_order_id`='".$order_id."' AND a.`pengiriman_mode`='2'";

     $data = DB::select($query);

     $biaya_pengurangan = $data[0]->total;
    // $biaya_pengurangan = $CI->db->query("
      // SELECT 
      // IFNULL(SUM(b.`pengirimandetail_qty` * ( IFNULL(c.`orderdetail_harga_pengiriman`,0) + IFNULL(e.`hargapengirimandetail_nominal`,0)) ),0) AS total
      // FROM duaagung_pengiriman a
      // LEFT JOIN duaagung_pengiriman_detail b ON a.`pengiriman_id`=b.`pengirimandetail_pengirimanid`
      // LEFT JOIN duaagung_order_detail c ON b.`pengirimandetail_orderdetailid`=c.`orderdetail_id`
      // LEFT JOIN duaagung_order d ON a.`pengiriman_orderid`=d.`order_id` AND d.`order_isdelete`='0'
      // LEFT JOIN duaagung_harga_pengiriman_detail e ON d.`order_is_from_history`='1' AND d.`order_harga_pengiriman_id` = e.`hargapengirimandetail_hargapengirimanid` AND c.`orderdetail_produkid`= e.`hargapengirimandetail_produkid`
      // WHERE a.`pengiriman_orderid`='".$order_id."' AND a.`pengiriman_mode`='2'
    //   ")->row()->total;
    
    // return $nominal - $biaya_pengurangan;
        return $nominal - $biaya_pengurangan;
    }
}

if (!function_exists("penyesuaian_harga_pengiriman_ekspedisi")) {
    function penyesuaian_harga_pengiriman_ekspedisi($order_id , $nominal = 0)
    {
        // $select = "
        //   a.`produk_id`, 
        //   a.`pengirimandetail_qty`, 
        //   IFNULL(a.`pengirimandetail_hargapengirimanekspedisi`,0)  AS pengirimandetail_hargapengirimanekspedisi, 
        //   a.`orderdetail_harga_pengiriman`, 
        //   IFNULL(d.`hargapengirimandetail_nominal` ,0) AS hargapengirimandetail_nominal
        // ";

        // $where['where']['a.`order_id`'] = $order_id;
        // $where['where']['a.`pengiriman_mode`'] = '1'; 

        // $join               = [];
        // $join[]             = ['table' => 'duaagung_harga_pengiriman_order b', 'on' => "a.`order_id`=b.`hargapengirimanorder_order_id` AND a.`pengiriman_rekananid` = b.`hargapengirimanorder_ekspedisi_id` AND b.`hargapengirimanorder_status`='DISETUJUI'", 'type' => 'LEFT' ];
        // $join[]             = ['table' => 'duaagung_harga_pengiriman_order_detail c', 'on' => "c.`hargapengirimanorderdetail_hargapengirimanorder_id` = b.`hargapengirimanorder_id` AND c.`hargapengirimanorderdetail_produk_id` = a.`produk_id`", 'type' => 'LEFT' ];
        // $join[]             = ['table' => 'duaagung_harga_pengiriman_detail d', 'on' => "a.`order_is_from_history`='1' AND a.`order_harga_pengiriman_id` = d.`hargapengirimandetail_hargapengirimanid` AND c.`hargapengirimanorderdetail_produk_id` = d.`hargapengirimandetail_produkid`", 'type' => 'LEFT' ];


        $query_vw = "SELECT
                        `p`.`pengiriman_id` AS `pengiriman_id`,
                        `p`.`pengiriman_no` AS `pengiriman_no`,
                        `p`.`pengiriman_mode` AS `pengiriman_mode`,
                        `p`.`pengiriman_is_cetak` AS `pengiriman_is_cetak`,
                        -- `ap`.`armadapengguna_armadaid` AS `armadapengguna_armadaid`,
                        -- `p`.`pengiriman_armadapenggunaid` AS `pengiriman_armadapenggunaid`,
                        `p`.`pengiriman_supir` AS `pengiriman_supir`,
                        `p`.`pengiriman_no_plat` AS `pengiriman_no_plat`,
                        `p`.`pengiriman_supir_id` AS `pengiriman_supir_id`,
                        `p`.`pengiriman_rekanan_id` AS `pengiriman_rekanan_id`,
                        `pr`.`produk_id` AS `produk_id`,
                        `pr`.`produk_nama` AS `produk_nama`,
                        -- `pr`.`produk_foto` AS `produk_foto`,
                        -- `pr`.`produk_berat` AS `produk_berat`,
                        -- `pr`.`produk_warna` AS `produk_warna`,
                        `pr`.`produk_satuan` AS `produk_satuan`,
                        `pd`.`pengirimandetail_qty` AS `pengirimandetail_qty`,
                        `pd`.`pengirimandetail_harga` AS `pengirimandetail_hargapengirimanekspedisi`,
                        -- `pd`.`pengirimandetail_notes` AS `pengirimandetail_notes`,
                        `od`.`orderdetail_qty` AS `orderdetail_qty`,
                        -- `od`.`orderdetail_catatan` AS `orderdetail_catatan`,
                        -- `od`.`orderdetail_harga_pengiriman` AS `orderdetail_harga_pengiriman`,
                        `o`.`order_id` AS `order_id`,
                        -- `o`.`order_is_perlu_buruh` AS `order_is_perlu_buruh`,
                        -- `o`.`order_is_from_history` AS `order_is_from_history`,
                        -- `o`.`order_harga_pengiriman_id` AS `order_harga_pengiriman_id`,
                        `gk`.`gudang_id` AS `gudang_id`,
                        `gk`.`gudang_nama` AS `gudang_nama`
                        -- `gk`.`gudang_nama_short` AS `gudang_nama_short` 
                    FROM
                        `trx_pengiriman` `p` LEFT JOIN `trx_pengiriman_detail` `pd` ON `p`.`pengiriman_id` = `pd`.`pengirimandetail_pengiriman_id`
                        LEFT JOIN `master_supir_armada` `ap` ON `p`.`pengiriman_supir_id` = `ap`.`supirarmada_id`
                        JOIN `trx_order_detail` `od` ON `pd`.`pengirimandetail_orderdetail_id` = `od`.`orderdetail_id`
                        JOIN `trx_order` `o` ON `od`.`orderdetail_order_id` = `o`.`order_id`
                        JOIN `master_gudang` `gk` ON `p`.`pengiriman_gudang_id` = `gk`.`gudang_id`
                        JOIN `master_produk` `pr` ON `od`.`orderdetail_produk_id` = `pr`.`produk_id`";

        // dd(DB::select($query_vw));
        // $getdata = $CI->m_general->get_data('array', 'vw_pengiriman_detail_small a', $select, $where, null, null, null, $join, null);
        // 
        $query = "SELECT 
                    a.`produk_id`, 
                    a.`pengirimandetail_qty`, 
                    IFNULL(a.`pengirimandetail_hargapengirimanekspedisi`, 0)  AS pengirimandetail_hargapengirimanekspedisi
                    -- a.`orderdetail_harga_pengiriman`, 
                    -- IFNULL(d.`hargapengirimandetail_nominal` ,0) AS hargapengirimandetail_nominal
                FROM (".$query_vw.") a 
                LEFT JOIN master_harga_pengiriman_order b on a.order_id = b.hargapengirimanorder_order_id AND hargapengirimanorder_ekspedisi_id = pengiriman_rekanan_id AND hargapengirimanorder_status = 'DISETUJUI'
                LEFT JOIN master_harga_pengiriman_order_detail c on hargapengirimanorder_id = hargapengirimanorderdetail_hargapengirimanorder_id AND hargapengirimanorderdetail_produk_id = a.produk_id
                WHERE a.order_id = '".$order_id."' AND pengiriman_mode = 'EKSPEDISI'
                ";

        $getdata = DB::select($query);
        
        $total_biaya_ekspedisi = 0;
        $total_biaya_ = 0;

        foreach ($getdata as $key => $rows) {
          $total_biaya_ekspedisi += $rows->pengirimandetail_qty * $rows->pengirimandetail_harga;
          $total_biaya_ += $rows->pengirimandetail_qty * ($rows->hargapengirimanorderdetail_nominal);
        }
        
        $nominal += ($total_biaya_ekspedisi - $total_biaya_);
        return $nominal;
        // return 1000;
    }
}
