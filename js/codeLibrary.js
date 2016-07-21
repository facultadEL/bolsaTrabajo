cantOfNumbers = 0;
cantOfUpper = 0;
cantOfLower = 0;
cantOfSymbol = 0;
maxLong = 0;
var dictionaryFull;
var dictionaryNAL;
var vDigitsPass = [];
var check;
var dictionary = {};
var excludedSymbols = [];

function newDigits()
{
	newDigit = "";
	for(var i = 1; i <= 8; i++)
	{
		if(i == 1)
		{
			newDigit += "0";
		}
		else
		{
			newDigit += Math.floor(Math.random() * 2);
		}
	}
	return newDigit;
}

function setDictionary()
{
	numberDictionary = {
		"00110000": "0",
		"00110001": "1",
		"00110010": "2",
		"00110011": "3",
		"00110100": "4",
		"00110101": "5",
		"00110110": "6",
		"00110111": "7",
		"00111000": "8",
		"00111001": "9",
	}
	symbolDictionary = {
		"00100001": "!",
		"00100011": "#",
		"00100100": "$",
		"00100101": "%",
		"00100110": "&",
		"00101010": "*",
		"00101011": "+",
		"00101101": "-",
		"00101110": ".",
		"00101111": "/",
		"00111010": ":",
		"00111011": ";",
		"00111101": "=",
		"00111111": "?",
		"01000000": "@",
		"01011011": "[",
		"01011101": "]",
		"01011111": "_",
		"01111110": "~",
	}
	letterUDictionary = {
		"01000001": "A",
		"01000010": "B",
		"01000011": "C",
		"01000100": "D",
		"01000101": "E",
		"01000110": "F",
		"01000111": "G",
		"01001000": "H",
		"01001001": "I",
		"01001010": "J",
		"01001011": "K",
		"01001100": "L",
		"01001101": "M",
		"01001110": "N",
		"01001111": "O",
		"01010000": "P",
		"01010001": "Q",
		"01010010": "R",
		"01010011": "S",
		"01010100": "T",
		"01010101": "U",
		"01010110": "V",
		"01010111": "W",
		"01011000": "X",
		"01011001": "Y",
		"01011010": "Z",
	}
	letterLDictionary =	{
		"01100001": "a",
		"01100010": "b",
		"01100011": "c",
		"01100100": "d",
		"01100101": "e",
		"01100110": "f",
		"01100111": "g",
		"01101000": "h",
		"01101001": "i",
		"01101010": "j",
		"01101011": "k",
		"01101100": "l",
		"01101101": "m",
		"01101110": "n",
		"01101111": "o",
		"01110000": "p",
		"01110001": "q",
		"01110010": "r",
		"01110011": "s",
		"01110100": "t",
		"01110101": "u",
		"01110110": "v",
		"01110111": "w",
		"01111000": "x",
		"01111001": "y",
		"01111010": "z",
	}
}

function getValue(binaryCode)
{
	digitToReturn = "";
	
	digitToReturn = dictionary[binaryCode];
	if(digitToReturn == null)
	{
		getValue(newDigits());
	}
	else
	{
		if(inObject(digitToReturn, symbolDictionary) != null)
		{
			cantOfSymbol = 1;
		}
		if(inObject(digitToReturn, numberDictionary) != null)
		{
			cantOfNumbers = 1;
		}
		if(inObject(digitToReturn, letterUDictionary) != null)
		{
			cantOfUpper = 1;
		}
		if(inObject(digitToReturn, letterLDictionary) != null)
		{
			cantOfLower = 1;
		}
	}
	
	return digitToReturn;
}

function inObject(value,dictionary)
{
	for (key in dictionary) {
   		if(value == dictionary[key])
   		{
   			return parseInt(key);
   		}
	}
	return null;
}


function getPass(longPass)
{
	cantOfLower = 0;
	cantOfNumbers = 0;
	cantOfSymbol = 0;
	cantOfUpper = 0;
	if(check == 0)
	{
		cantOfSymbol = 1;
	}
	countOfDigits = 0;
	digitsToAdd = "";
	finalPass = "";
	vDigitsPass.length = 0;
	cantOfDigitsPass = longPass * 8;
	for(var i = 1; i <= cantOfDigitsPass; i++)
	{
		countOfDigits++;
		if(countOfDigits == 1)
		{
			digit = 0;
		}
		else
		{
			digit = Math.floor(Math.random() * 2);
		}
		digitsToAdd += digit;
		if(countOfDigits == 8)
		{
			vDigitsPass.push(digitsToAdd);
			countOfDigits = 0;
			digitsToAdd = "";
		}
	}
	for(var i = 0; i < vDigitsPass.length; i++)
	{
		finalPass += getValue(vDigitsPass[i]);
	}
	
	if(cantOfLower == 1 && cantOfNumbers == 1 && cantOfSymbol == 1 && cantOfUpper == 1)
	{
		return finalPass;
	}
	else
	{
		getPass(longPass);
	}
}

function loadDictionaries()
{
	var nullDictionary = {};
	dictionary = nullDictionary;

	if(check == 1)
	{
		$.each( symbolDictionary, function( key, value ) {
			if($.inArray(key, excludedSymbols) == -1)
			{
				dictionary[key] = value;
			}
		});
		$.each( numberDictionary, function( key, value ) {
			if($.inArray(key, excludedSymbols) == -1)
			{
				dictionary[key] = value;
			}
		});
		$.each( letterUDictionary, function( key, value ) {
			if($.inArray(key, excludedSymbols) == -1)
			{
				dictionary[key] = value;
			}
		});
		$.each( letterLDictionary, function( key, value ) {
			if($.inArray(key, excludedSymbols) == -1)
			{
				dictionary[key] = value;
			}
		});
	}
	else
	{
		cantOfSymbol = 1;
		$.each( numberDictionary, function( key, value ) {
			if($.inArray(key, excludedSymbols) == -1)
			{
				dictionary[key] = value;
			}
		});
		$.each( letterUDictionary, function( key, value ) {
			if($.inArray(key, excludedSymbols) == -1)
			{
				dictionary[key] = value;
			}
		});
		$.each( letterLDictionary, function( key, value ) {
			if($.inArray(key, excludedSymbols) == -1)
			{
				dictionary[key] = value;
			}
		});
	}
}


function popSimbol(nameSimbol,simbolKey, simbolValue)
{
	simbolCheck = $('#'+nameSimbol).is(':checked');
	if(simbolCheck == false)
	{
		delete dictionary[simbolKey];
		excludedSymbols.push(simbolKey);
	}
	else
	{
		dictionary[simbolKey] = simbolValue;
		excludedSymbols.splice($.inArray(simbolKey,excludedSymbols), 1);
	}
}

//Type
//0 - Numeros y Letras
//1 - Numeros, letras y caracteres
function getCode(long,type)
{
	type || (type = 0);
	check = type;

	setDictionary();
	loadDictionaries();
	return getPass(long);
}