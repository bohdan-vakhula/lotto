function Mapper(_cart, _creaditCard) {
    this.inputCart = _cart;
    this.CreditCard = _creaditCard;
    this.initialize = function () {
        var outputCartArr = []
        this.inputCart.items.forEach(function (cartItem) {
            var outputItem;
            if (cartItem.getProductIdSpecial() == 999) {
                var exists = false;
                outputCartArr.forEach(function (outputCartItem) {
                    if (outputCartItem.guid == cartItem.getGuid())
                        exists = true;
                })
                if (true) {
                    outputItem = new OlapProduct(cartItem.getLotteryType(), cartItem.getNumberOfDraws(), cartItem.getNumberOfLines(), cartItem.getId(), cartItem.getIsFastProcessing(), !cartItem.getIsSubscription(), ['1,2,3,4,5,6'], cartItem.getQuantity(), cartItem.getGuid(), cartItem.getProductIdSpecial(),cartItem.getOriginalPrice());
                }
            }
            else {
                //debugger;
                switch (cartItem.getProductType()) {
                    case 1:
                        outputItem = new PersonalProduct(cartItem.getLotteryType(), cartItem.getNumberOfDraws(), cartItem.getNumberOfLines(), cartItem.getId(), cartItem.getIsFastProcessing(), !cartItem.getIsSubscription(), cartItem.getNumbersSantized(), cartItem.getQuantity());
                        break;
                    case 3:
                        outputItem = new GroupProduct(cartItem.getLotteryType(), cartItem.getNumberOfDraws(), cartItem.getGroupnoshares(), cartItem.getId(), cartItem.getIsFastProcessing(), !cartItem.getIsSubscription(), cartItem.getQuantity());
                        break;
                    case 2:
                    case 4:
                    case 5:
                    case 6:
                    case 14:
                    case 18:
                    case 19:
                    case 666:
                        outputItem = new NavidadProduct(cartItem.getProductType(), cartItem.getLotteryType(), cartItem.getNumberOfDraws(), cartItem.getNumberOfLines(), cartItem.getId(), cartItem.getIsFastProcessing(), !cartItem.getIsSubscription(), new Array(cartItem.getNumbersSantized().join("/")), cartItem.getQuantity());
                        break;
                    case 15:
                    case 20:
                    case 24:
                    case 26:
                    case 31:
                        outputItem = new NavidadProduct(cartItem.getProductType(), cartItem.getLotteryType(), cartItem.getNumberOfDraws(), cartItem.getNumberOfLines(), cartItem.getId(), cartItem.getIsFastProcessing(), !cartItem.getIsSubscription(), new Array(cartItem.getTicketsNumbersId().join()), cartItem.getQuantity());
                        break;
                    default:
                        throw "No such handler!Mapper.js";
                }
            }
            if (outputItem) {
                outputCartArr.push(outputItem);
            }
        })
        return outputCartArr;
    }
    this.outputCart = this.initialize();

}

Mapper.prototype.mapCart = function () {
    var cartStrfied = '';
    var cartLength = Object.keys(this.outputCart).length;
    for (var z = 0; z < Object.keys(this.outputCart).length; z++) {
        cartStrfied += this.outputCart[z].stringifyProduct() + ((cartLength > 1) ? '|' : '');
        cartLength--;
    }
    return cartStrfied;
}
Mapper.prototype.PrepareOrder = function () {
    var prepOrderRequest = new PrepareOrderRequest(this.mapCart(), this.inputCart.reedemCode);
    return JSON.stringify(prepOrderRequest);
}
Mapper.prototype.ConfirmOrder = function () {
    // debugger;
    var cnfOrderReq = new ConfirmOrderRequest(this.inputCart.phoneOrEmail, this.inputCart.processor, this.inputCart.reedemCode, this.inputCart.paymentMethodId, this.inputCart.affiliateCode, this.inputCart.olapAffiliateCode);
    var cartItemsCount = 1;
    var guidArr = [];
    this.outputCart.forEach(function (cartItem) {
        if (cartItem instanceof OlapProduct ) {
            if (guidArr.indexOf(cartItem.guid) < 0) 
                guidArr.push(cartItem.guid);
        }
        else {
            var odrDataItem = new OrderDataItem(1, cartItem.numOfDraws, cartItem.numOfLines, cartItem.Quantity);
            cartItem.selectedNumbers.forEach(function (lineItem) {
                var lnDataItem = new LineDataItem(cartItem.LotteryTypeID, lineItem, cartItem.isVip, cartItem.isCash, 1, cartItem.ProductId);
                odrDataItem.AddLineDataItem(lnDataItem);
            })
            cnfOrderReq.AddOrderDateItem(odrDataItem);
            cartItemsCount++;
        }
    })
    if (this.CreditCard) {
        cnfOrderReq.AddCreditCard(this.CreditCard);
    }
    if (guidArr.length > 0)
        cnfOrderReq.AddGuid(guidArr.join("|"));

    return cnfOrderReq.stringifyConfirmRequest();
}

function Product(_productId, _lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity) {
    this.MemberId = '{0}';
    this.ProductId = _productId;
    this.LotteryTypeID = _lotteryTypeID;
    this.numOfDraws = _numOfDraws;
    this.numOfLines = _numOfLines;
    this.externalId = _externalId;
    this.isVip = _isVip;
    this.isCash = _isCash;
    this.selectedNumbers = _selectedNumbers;
    this.Quantity = _quantity;
}

Product.prototype = {
    constructor: Product,
    stringifyProduct: function () {
        var strfied = "";
        // debugger;
        for (var cnt = this.Quantity; cnt > 0; cnt--) {
            strfied += 'MemberId=' + this.MemberId + '&ProductId=' + this.ProductId + '&LotteryTypeID=' + this.LotteryTypeID + '&numOfDraws=' + this.numOfDraws + '&numOfLines=' + this.numOfLines + '&externalId=' + this.externalId + '&isVip=' + this.isVip + '&isCash=' + this.isCash + '&selectedNumbers=' + this.selectedNumbers + ((cnt > 1) ? "|" : "");
        }
        return strfied;
    }
}

function PersonalProduct(_lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity) {
    Product.call(this, 1, _lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity);
}
inheritPrototype(PersonalProduct, Product);

function Product666(_lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity) {
    Product.call(this, 666, _lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity);
}
inheritPrototype(PersonalProduct, Product);

function GroupProduct(_lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _quantity) {
    Product.call(this, 3, _lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, [""], _quantity);
}
inheritPrototype(GroupProduct, Product);

function NavidadProduct(_productID, _lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity) {
    Product.call(this, _productID, _lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity);
}
inheritPrototype(NavidadProduct, Product);

function SpecialProduct(_productID, _lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity) {
    Product.call(this, _productID, _lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity);
}
inheritPrototype(SpecialProduct, Product);

function OlapProduct(_lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity,_guid,_productIdSpecial,_amount) {
    Product.call(this, 999, _lotteryTypeID, _numOfDraws, _numOfLines, _externalId, _isVip, _isCash, _selectedNumbers, _quantity);
    this.guid = _guid;
    this.productIdSpecial = _productIdSpecial;
    this.amount = _amount;
}
inheritPrototype(OlapProduct, Product);

OlapProduct.prototype.stringifyProduct = function () {
    var strfied = "";
    // debugger;
    for (var cnt = this.Quantity; cnt > 0; cnt--) {
        strfied += 'MemberId=' + this.MemberId + '&ProductId=' + this.ProductId + '&LotteryTypeID=' + this.LotteryTypeID + '&numOfDraws=' + this.numOfDraws + '&numOfLines=' + this.numOfLines + '&externalId=' + this.externalId + '&isVip=' + this.isVip + '&Amount=' + this.amount + '&isCash=' + this.isCash + '&selectedNumbers=' + this.selectedNumbers + ((cnt > 1) ? "|" : "");
    }
    return strfied;
}

function PrepareOrderRequest(_productNumsLottery, _redeemCode) {
	this.MemberId = '{0}';
    this.ReedemCode = _redeemCode ? _redeemCode : "";
    this.ProductNumsLottery = _productNumsLottery; //this is the stringified cart

}

function ConfirmOrderRequest(_phoneOrEmail, _processorApi, _redeemCode, _paymentMethodId, _affiliateId, _olapAffiliateId) {
    this.PhoneOrEmail = _phoneOrEmail;
    this.ProcessorApi = (_processorApi) ? _processorApi : "";
    this.ReedemCode = _redeemCode ? _redeemCode : "";
    if (_paymentMethodId)
        this.PaymentMethodId = _paymentMethodId;
    this.AffiliateId = _affiliateId;
    if (_olapAffiliateId)
        this.OlapAffiliateId = _olapAffiliateId
    this.SessionId = '{0}';
    this.MemberId = '{0}';
    this.OrderData = [] //array of cartItems
}
ConfirmOrderRequest.prototype = {
    constructor: ConfirmOrderRequest,
    AddOrderDateItem: function (_orderDateItem) {
        this.OrderData.push(_orderDateItem)
    },
    AddCreditCard: function (_creditCard) {
        this.PaymentMethodId = 0;
        this.ProcessorApi = "CreditCard";
        this.CreditCard = _creditCard;
        this.CreditCard.CardType = _getCreditCardType(_creditCard.CreditCardNumber);
    },
    AddGuid: function (_guid) {
        this.guid = _guid
    },
    stringifyOrderData: function () {
        var orderItemStrfied = "";
        for (var i = 0; i < this.OrderData.length; i++) {
            orderItemStrfied += this.OrderData[i].stringify();

            orderItemStrfied += (i + 1 < this.OrderData.length) ? "|" : "";
        }
        return orderItemStrfied;
    },
    stringifyConfirmRequest: function () {
        this.OrderData = this.stringifyOrderData();
        return JSON.stringify(this);
    }
}

function OrderDataItem(_productCounter, _numOfDraws, _numOfLines, _quantity,_guid) {
    this.EmailCode = '{emailcode}';
    this.productCounter = _productCounter;
    this.numOfDraws = _numOfDraws;
    this.numOfLines = _numOfLines;
    this.Quantity = _quantity;
    this.linesData = []; //array of lineData
}
OrderDataItem.prototype.stringify = function () {
    var OrderDataItemStrfied = ""
    for (var cnt = this.Quantity; cnt > 0; cnt--) {
        OrderDataItemStrfied += 'EmailCode=' + this.EmailCode + '&' + "productCounter=" + this.productCounter + "&" + "numOfDraws=" + this.numOfDraws + "&" + "numOfLines=" + this.numOfLines + "&";
        var length = this.linesData.length;
        this.linesData.forEach(function (lineDataItem) {
            OrderDataItemStrfied += lineDataItem.stringify();
            length--;
            if (length > 0)
                OrderDataItemStrfied += "|";
        })
        if (cnt > 1)
            OrderDataItemStrfied += "|";
    }
    return OrderDataItemStrfied;
}

OrderDataItem.prototype.AddLineDataItem = function (lineDataItem) {
    this.linesData.push(lineDataItem);
}

function LineDataItem(_lotteryTypeID, _selectedNumbers, _isVIP, _isCash, _isOnline, _productID) {
    this.MemberId = '{0}',
    this.LotteryTypeID = _lotteryTypeID;
    this.SelectedNumbers = _selectedNumbers;
    this.IsVIP = _isVIP;
    this.IsCash = _isCash;
    this.isOnline = _isOnline;
    this.ProductID = _productID;
}
LineDataItem.prototype.stringify = function () {
    return 'MemberId=' + this.MemberId + '&LotteryTypeID=' + this.LotteryTypeID + '&SelectedNumbers=' + this.SelectedNumbers + '&IsVIP=' + this.IsVIP + '&IsCash=' + this.IsCash + '&isOnline=' + this.isOnline + '&ProductID=' + this.ProductID;
}

function inheritPrototype(childObject, parentObject) {
    var copyOfParent = Object.create(parentObject.prototype);
    copyOfParent.constructor = childObject;
    childObject.prototype = copyOfParent;
}


//*****************************************
//
//		    Validating Credit card
//
//*****************************************


/**
 * Validating credit card number
 * @param {String} credit card number
 * @param {String} name
 * @return {String} error messsage
 */
function validateCreditCardNumber(cardnumber, name) {

    var trimmedcardnumber = cardnumber.trim();

    var title = "Card number";
    if (typeof name !== 'undefined') {
        title = name;
    }

    if (trimmedcardnumber === '') {
        return title + " should not be empty!";
    } else if (cardnumber.length < 16) {
        return title + " is not a valid number";
    } else if (!valid_credit_card(trimmedcardnumber)) {
        return title + " is not a valid number";
    } else {
        return "";
    }

    function valid_credit_card(value) {
        // accept only digits, dashes or spaces
        if (/[^0-9-\s]+/.test(value)) return false;

        // The Luhn Algorithm. It's so pretty.
        var nCheck = 0, nDigit = 0, bEven = false;
        value = value.replace(/\D/g, "");

        for (var n = value.length - 1; n >= 0; n--) {
            var cDigit = value.charAt(n),
                nDigit = parseInt(cDigit, 10);

            if (bEven) {
                if ((nDigit *= 2) > 9) nDigit -= 9;
            }

            nCheck += nDigit;
            bEven = !bEven;
        }

        return (nCheck % 10) == 0;
    }
}


/**
    * Get type of credit card by number
    * @param {String} credit card number 
    * @return {String} credit card type
    */
function _getCreditCardType(number) {
    //debugger;
    // visa
    var re = new RegExp("^4");
    if (number.match(re) != null)
        return "Visa";

    // Mastercard
    re = new RegExp("^5[1-5]");
    if (number.match(re) != null)
        return "Mastercard";

    // AMEX
    re = new RegExp("^3[47]");
    if (number.match(re) != null)
        return "AMEX";

    // Discover
    re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
    if (number.match(re) != null)
        return "Discover";

    // Diners
    re = new RegExp("^36");
    if (number.match(re) != null)
        return "Diners";

    // Diners - Carte Blanche
    re = new RegExp("^30[0-5]");
    if (number.match(re) != null)
        return "Diners - Carte Blanche";

    // JCB
    re = new RegExp("^35(2[89]|[3-8][0-9])");
    if (number.match(re) != null)
        return "JCB";

    // Visa Electron
    re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
    if (number.match(re) != null)
        return "Visa Electron";

    return "Visa";
};


function deepCopy(obj) {
    if (Object.prototype.toString.call(obj) === '[object Array]') {
        var out = [], i = 0, len = obj.length;
        for (; i < len; i++) {
            out[i] = arguments.callee(obj[i]);
        }
        return out;
    }
    if (typeof obj === 'object') {
        var out = {}, i;
        for (i in obj) {
            out[i] = arguments.callee(obj[i]);
        }
        return out;
    }
    return obj;
}