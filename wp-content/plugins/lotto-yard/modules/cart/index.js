// angular code

var icelotto = angular.module('myApp', ['ngCart', 'angular-cache', 'ngResource', 'ngDialog', 'fancyboxplus', 'countdownApp', 'animateNumbersModule']);

//config cart
icelotto.value('RESTApiUrl', CONFIG.adminURL);
icelotto.value('cartTranslationUrl', CART_CONFIG.CART_TRANSLATION_URL);

//paymentsystem List
icelotto.constant("PaymentSystems", [
                            { "name": "creditcard", "logo": "creditcards.png", "processor": "CreditCard", "needmoreinfo": 1 },
                            /*{ "name": "yandex", "logo": "yandexlogo.png", "processor": "PayboutiqueYandex", "needmoreinfo": 0 },
                            { "name": "qiwi", "logo": "qiwinew.png", "processor": "PayboutiqueQiwi", "needmoreinfo": 1 },
                            { "name": "neteller", "logo": "neteller.png", "processor": "Neteller", "needmoreinfo": 1 },*/
                            ]);
                            // {  "name": "skrill", "logo": "skrilllogo.png", "processor": "Skrill", "needmoreinfo": 0 }
                            // { "name": "yandex", "logo": "yandexlogo.png", "processor": "AccentPayYandex", "needmoreinfo": 0 },
                            // { "name": "moneta", "logo": "monetalogo.png", "processor": "AccentPayMonetaRu", "needmoreinfo": 0 },
                            // { "name": "c24", "logo": "c24logo.png", "processor": "AccentPayContact24", "needmoreinfo": 1 },
                            // { "name": "compay", "logo": "compaylogo.png", "processor": "AccentPayComepay", "needmoreinfo": 1 }]

//4,14,19,2,3
icelotto.constant("Products", [
							{ "id": "1", "Name": "Personal" },
							{ "id": "2", "Name": "PersonalAndGroup" },
                            { "id": "3", "Name": "Group" },
                            { "id": "14", "Name": "TopLottoGroup" }
                ]);

icelotto.constant("ErrorMessages",
    {
        "en": [
            { "error": "'Email' is not a valid email address.", "text": "Email is not a valid email address."},
            { "error": "Email already exists.", "text": "You already have an account with us, please login." },
            { "error": "Please insert valid password", "text": "Password length must be between 7 to 20 characters." },
            { "error": "Please insert valid full name", "text": "Please insert valid full name." },
            { "error": "Name must not include numbers and be 2-20 characters.", "text": "Name must not include numbers and be 2-20 characters." },
            { "error": "'Email' should not be empty", "text": "'Email' should not be empty." },
            { "error": "Invalid Email format", "text": "Invalid Email format." },
            { "error": "Property Mobile Number is not a valid phone number!", "text": "Mobile Number is not a valid phone number!" },
            { "error": "Credit card number length is invalid", "text": "Credit card number length is invalid." },
            { "error": "The Min Deposit Is 2EUR", "text": "The Min Deposit Is 2EUR." },
            { "error": "CardNumber -> Card Number is not a valid credit card number", "text": "Credit Card number is invalid." },
            { "error": "CreditCardAlreadyExist", "text": "This Credit Card already exists." },
            { "error": "Enter credit card", "text": "Enter credit card." },
            { "error": "Please agree with our Terms and Conditions!", "text": "Please agree with our Terms and Conditions!" },
            { "error": "Please type your full name", "text": "Please type your full name." },
            { "error": "Card Number is not a valid credit card number", "text": "Card Number is not a valid credit card number." },
            { "error": "Please insert Expiration Date", "text": "Please insert Expiration Date." },
            { "error": "Please insert Expiration Year", "text": "Please insert Expiration Year." },
            { "error": "Please insert Expiration Month", "text": "Please insert Expiration Month." },
            { "error": "Please insert your cvv number", "text": "Please insert your cvv number." },
            { "error": "Please enter valid card expiration date!", "text": "Please enter valid card expiration date." },
            { "error": "The Min Deposit Is 5EUR", "text": "The Min Deposit Is 5EUR." },
            { "error": "ProcessorRequestFaild", "text": "Failed." },
            { "error": "BankDeclainTransaction", "text": "Bank Declines Transaction." },
            { "error": "Bad format detected", "text": "Bad format detected." },
            { "error": "TransactionNotPermittedOnCard", "text": "Transaction not permitted on Card." },
            { "error": "UnknownError", "text": "Failed." },
            { "error": "ErrorPurchaseProducts", "text": "Error Purchase Products." },
            { "error": "CVV -> 'C V V' is not in the correct format.", "text": "CVV is not in the correct format." },
            { "error": "CVV -> 'C V V' is not in the correct format.CardNumber -> Card Number is not a valid credit card number", "text": "Credit Card number is invalid!" }

        ],
        "de": [
            { "error": "Name must not include numbers and be 2-20 characters", "text": "Name must not include numbers and be 2-20 characters" },
            { "error": "Email already exists.", "text": "Sie haben bereits ein Konto bei uns, bitte anmelden" },
            { "error": "Please insert valid password", "text": "Bitte geben gültigen passwort" },
            { "error": "Please insert valid full name", "text": "Bitte geben gültigen Vornamen" },
            { "error": "'Email' should not be empty.", "text": "Ungültige E-Mail foramt" },
            { "error": "Property Mobile Number is not a valid phone number!", "text": "- Zahlen bestehen" },

            { "error": "Login failed", "text": "Username or password are incorrect" },
            { "error": "Please insert valid email", "text": "Please insert valid email" },
            { "error": "Please insert valid password", "text": "Please insert valid password" },
            { "error": "Please insert valid full name", "text": "Please insert valid full name" },
            { "error": "Please insert valid phone number", "text": "Please insert valid phone number" },
            { "error": "Password length must be between 7 to 20 characters", "text": "Password length must be between 7 to 20 characters" },

            //Credit card messages
            { "error": "Please type your full name", "text": "Bitte geben Sie Ihren vollständigen Namen ein" },
            { "error": "Credit card number length is invalid", "text": "Die Länge der Kreditkartennummer ist ungültig" },
            { "error": "Please insert your cvv number", "text": "Bitte geben Sie Ihre CVV-Nummer ein" },
            { "error": "Please insert Expiration Date", "text": "Bitte geben Sie das Ablaufdatum ein" },
            { "error": "Please insert Expiration Year", "text": "Bitte geben Sie das Ablaufjahr ein" },
            { "error": "Expiration date is wrong", "text": "Ablaufdatum ist falsch" },
            { "error": "Please accept our Terms and Conditions", "text": "Bitte akzeptieren Sie unsere AGBs" },
            { "error": "CVV must contain 3-4 digits", "text": "Der CVV muss aus 3-4 Ziffern bestehen" },
            { "error": "CardNumber -> Card Number is not a valid credit card number", "text": "Card Number is not a valid credit card number" },
            { "error": "CreditCardAlreadyExist ", "text": "Credit Card Already Exists" },
            { "error": "CVV -> 'C V V' is not in the correct format", "text": "CVV is not in the correct format" },
            { "error": "CVV -> 'C V V' is not in the correct format.", "text": "CVV is not in the correct format" },
        ],
        "fr": [
            { "error": "Name must not include numbers and be 2-20 characters", "text": "Name must not include numbers and be 2-20 characters" },
            { "error": "Email already exists.", "text": "Vous avez déjà un compte avec nous, s'il vous plaît connecter" },
            { "error": "Please insert valid password", "text": "Password length must be between 7 to 20 characters" },
            { "error": "Please insert valid full name", "text": "Name must not include numbers and be 2-20 characters." },
            { "error": "'Email' should not be empty.", "text": "Invalid Email format" },
            { "error": "Property Mobile Number is not a valid phone number!", "text": "Phone should contain numbers only!!" },

            { "error": "Login failed", "text": "Username or password are incorrect" },
            { "error": "Please insert valid email", "text": "Please insert valid email" },
            { "error": "Please insert valid password", "text": "Please insert valid password" },
            { "error": "Please insert valid full name", "text": "Please insert valid full name" },
            { "error": "Please insert valid phone number", "text": "Please insert valid phone number" },
            { "error": "Password length must be between 7 to 20 characters", "text": "Password length must be between 7 to 20 characters" },

            //Credit card messages
            { "error": "Please type your full name", "text": "Veuillez saisir votre nom complet" },
            { "error": "Credit card number length is invalid", "text": "La longueur du numéro de carte de crédit est invalide" },
            { "error": "Please insert your cvv number", "text": "Veuillez indiquer votre numéro CVV" },
            { "error": "Please insert Expiration Date", "text": "Veuillez saisir la date d'expiration" },
            { "error": "Please insert Expiration Year", "text": "Veuillez saisir l'année d'expiration" },
            { "error": "Expiration date is wrong", "text": "La date d'expiration est incorrecte" },
            { "error": "Please accept our Terms and Conditions", "text": "Veuillez accepter nos Conditions générales" },
            { "error": "CVV must contain 3-4 digits", "text": "Le numéro CVV doit comporter 3 à 4 chiffres" },
            { "error": "CardNumber -> Card Number is not a valid credit card number", "text": "Card Number is not a valid credit card number" },
            { "error": "CreditCardAlreadyExist ", "text": "Credit Card Already Exists" },
            { "error": "CVV -> 'C V V' is not in the correct format", "text": "CVV is not in the correct format" },
            { "error": "CVV -> 'C V V' is not in the correct format.", "text": "CVV is not in the correct format" },
        ],
        "ru": [
            { "error": "Name must not include numbers and be 2-20 characters", "text": "Name must not include numbers and be 2-20 characters" },
            { "error": "Email already exists.", "text": "У вас уже есть аккаунт в нашей системе, пожалуйста, войдите" },
            { "error": "Please insert valid password", "text": "Password length must be between 7 to 20 characters" },
            { "error": "Please insert valid full name", "text": "Name must not include numbers and be 2-20 characters." },
            { "error": "'Email' should not be empty.", "text": "Invalid Email format" },
            { "error": "Property Mobile Number is not a valid phone number!", "text": "Phone should contain numbers only!!" },


            { "error": "Login failed", "text": "Username or password are incorrect" },
            { "error": "Please insert valid email", "text": "Please insert valid email" },
            { "error": "Please insert valid password", "text": "Please insert valid password" },
            { "error": "Please insert valid full name", "text": "Please insert valid full name" },
            { "error": "Please insert valid phone number", "text": "Please insert valid phone number" },
            { "error": "Password length must be between 7 to 20 characters", "text": "Password length must be between 7 to 20 characters" },

            //Credit card messages
            { "error": "Please type your full name", "text": "Введите свое имя и фамилию" },
            { "error": "Credit card number length is invalid", "text": "Неверная длина номера кредитной карты" },
            { "error": "Please insert your cvv number", "text": "Укажите свой CVV-код" },
            { "error": "Please insert Expiration Date", "text": "Введите день срока истечения срока деятельности" },
            { "error": "Please insert Expiration Year", "text": "Введите год истечения срока действия" },
            { "error": "Expiration date is wrong", "text": "Неверная дата истечения срока годности" },
            { "error": "Please accept our Terms and Conditions", "text": "Примите наши Положения и условия " },
            { "error": "CVV must contain 3-4 digits", "text": "CVV-код должен содержать 3-4 цифры" },
            { "error": "CardNumber -> Card Number is not a valid credit card number", "text": "Card Number is not a valid credit card number" },
            { "error": "CreditCardAlreadyExist ", "text": "Credit Card Already Exists" },
            { "error": "CVV -> 'C V V' is not in the correct format", "text": "CVV is not in the correct format" },
            { "error": "CVV -> 'C V V' is not in the correct format.", "text": "CVV is not in the correct format" },
        ],
        "es": [
            { "error": "Name must not include numbers and be 2-20 characters", "text": "Name must not include numbers and be 2-20 characters" },
            { "error": "Email already exists.", "text": "You already have an account with us, please login" },
            { "error": "Please insert valid password", "text": "Password length must be between 7 to 20 characters" },
            { "error": "Please insert valid full name", "text": "Name must not include numbers and be 2-20 characters." },
            { "error": "'Email' should not be empty.", "text": "Invalid Email format" },
            { "error": "Property Mobile Number is not a valid phone number!", "text": "Phone should contain numbers only!!" },

            { "error": "Login failed", "text": "Username or password are incorrect" },
            { "error": "Please insert valid email", "text": "Please insert valid email" },
            { "error": "Please insert valid password", "text": "Please insert valid password" },
            { "error": "Please insert valid full name", "text": "Please insert valid full name" },
            { "error": "Please insert valid phone number", "text": "Please insert valid phone number" },
            { "error": "Password length must be between 7 to 20 characters", "text": "Password length must be between 7 to 20 characters" },

            //Credit card messages
            { "error": "Please type your full name", "text": "Escriba su nombre completo, por favor" },
            { "error": "Credit card number length is invalid", "text": "La longitud del número de la tarjeta de crédito no es válida" },
            { "error": "Please insert your cvv number", "text": "Introduzca, por favor, el código CVV de detrás" },
            { "error": "Please insert Expiration Date", "text": "Por favor, introduzca la fecha de caducidad" },
            { "error": "Please insert Expiration Year", "text": "Por favor, introduzca el año en que caduca" },
            { "error": "Expiration date is wrong", "text": "La fecha de caducidad está equivocada" },
            { "error": "Please accept our Terms and Conditions", "text": "Acepte, por favor, nuestros Términos y condiciones" },
            { "error": "CVV must contain 3-4 digits", "text": "El CVV debe tener 3-4 dígitos" },
            { "error": "CardNumber -> Card Number is not a valid credit card number", "text": "Card Number is not a valid credit card number" },
            { "error": "CreditCardAlreadyExist ", "text": "Credit Card Already Exists" },
            { "error": "CVV -> 'C V V' is not in the correct format", "text": "CVV is not in the correct format" },
            { "error": "CVV -> 'C V V' is not in the correct format.", "text": "CVV is not in the correct format" },
        ],
        "nl": [
            { "error": "Name must not include numbers and be 2-20 characters", "text": "Name must not include numbers and be 2-20 characters" },
            { "error": "Email already exists.", "text": "You already have an account with us, please login" },
            { "error": "Please insert valid password", "text": "Password length must be between 7 to 20 characters" },
            { "error": "Please insert valid full name", "text": "Name must not include numbers and be 2-20 characters." },
            { "error": "'Email' should not be empty.", "text": "Invalid Email format" },
            { "error": "Property Mobile Number is not a valid phone number!", "text": "Phone should contain numbers only!!" },

            { "error": "Login failed", "text": "Username or password are incorrect" },
            { "error": "Please insert valid email", "text": "Please insert valid email" },
            { "error": "Please insert valid password", "text": "Please insert valid password" },
            { "error": "Please insert valid full name", "text": "Please insert valid full name" },
            { "error": "Please insert valid phone number", "text": "Please insert valid phone number" },
            { "error": "Password length must be between 7 to 20 characters", "text": "Password length must be between 7 to 20 characters" },

            //Credit card messages
            { "error": "Please type your full name", "text": "Typ je volledige naam" },
            { "error": "Credit card number length is invalid", "text": "Lengte van het creditcardnummer is ongeldig" },
            { "error": "Please insert your cvv number", "text": "Vul je CVC-nummer in" },
            { "error": "Please insert Expiration Date", "text": "Vul de vervaldatum in" },
            { "error": "Please insert Expiration Year", "text": "Vul het vervaljaar in" },
            { "error": "Expiration date is wrong", "text": "De vervaldatum is onjuist" },
            { "error": "Please accept our Terms and Conditions", "text": "Ga akkoord met onze algemene voorwaarden" },
            { "error": "CVV must contain 3-4 digits", "text": "CVC moet 3-4 cijfers bevatten" },
            { "error": "CardNumber -> Card Number is not a valid credit card number", "text": "Card Number is not a valid credit card number" },
            { "error": "CreditCardAlreadyExist ", "text": "Credit Card Already Exists" },
            { "error": "CVV -> 'C V V' is not in the correct format", "text": "CVV is not in the correct format" },
            { "error": "CVV -> 'C V V' is not in the correct format.", "text": "CVV is not in the correct format" },
        ]
    }
);
