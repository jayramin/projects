/* Luhn Mod-10 */
function CheckCreditCard(e){
	// alert(e);
	var type = $("#Type").val();
	var response = '';
	if (type=='VISA') {
		response = isVisa(e);
	}else if(type=='MC'){
		response = isMasterCard(e);
	}else if(type=='Discover'){
		response = isDiscover(e);
	}else if(type=='AMEX'){
		response = isAmericanExpress(e);
	}else{
		response ="Invalid";
	}
	alert(response);
}
function isCreditCard ( nCC ) {
	var bReturn=false, nSum=0, nMultiplier=1, nLen=nCC.length, i, nProduct, nDigit;
	
	if ( nCC.length <= 19 ) {
		for ( i=0; i < nLen; i ++) {
			nDigit = nCC.substring ( nLen - i - 1, nLen - i );
			nProduct=parseInt ( nDigit, 10 ) * nMultiplier;
			if ( nProduct >= 10 )
				nSum += ( nProduct % 10 ) + 1;
			else
				nSum += nProduct;
			if ( nMultiplier == 1 )
				nMultiplier ++;
			else
				nMultiplier --;
		}
	}
	
	if ( nSum % 10 == 0 )
		bReturn=true;

	return bReturn;
}

function isVisa ( nCC, bCompute ) {
	var bReturn=false;
	if (( nCC.length == 16 || nCC.length == 13 ) && nCC.substring ( 0, 1 ) == 4 ) {
		if ( bCompute )
			bReturn=isCreditCard ( nCC );
		else
			bReturn=true;
	}
	return bReturn;
}

function isMasterCard ( nCC, bCompute ) {
	var bReturn=false, nFirstDigit=nCC.substring ( 0, 1 ), nSecondDigit=nCC.substring ( 1, 2 );
	if ( nCC.length == 16 && nFirstDigit == 5 && nSecondDigit >= 1 && nSecondDigit <= 5 ) {
		if ( bCompute )
			bReturn=isCreditCard(nCC);
		else
			bReturn=true;
	}
	return bReturn;
}

function isAmericanExpress ( nCC, bCompute ) {
	var bReturn=false, nFirstDigit=nCC.substring ( 0, 1 ), nSecondDigit=nCC.substring ( 1, 2 );
	if ( nCC.length == 15 && nFirstDigit == 3 && ( nSecondDigit == 4 || nSecondDigit == 7 )) {
		if ( bCompute )
			bReturn=isCreditCard ( nCC );
		else
			bReturn=true;
	}
	return bReturn;
}

function isDiscover ( nCC, bCompute ) {
	var bReturn=false;
	if ( nCC.length == 16 && nCC.substring ( 0, 4 ) == "6011" ) {
		if ( bCompute )
			bReturn=isCreditCard ( nCC );
		else
			bReturn=true;
	}
	return bReturn;
}

function isAnyCard ( nCC ) {
	var bReturn=false;
	if ( isCreditCard ( nCC ) && ( isMasterCard ( nCC, false ) || isVisa ( nCC, false ) || isAmericanExpress ( nCC, false ) || isDiscover ( nCC, false )))
		bReturn=true;
	return bReturn;
}
