<form action="https://test.payu.in/_payment" method="post" id="payuForm" name="payuForm">
		                <input type="hidden" name="key" value="4CipxqGn" />
		                <input type="text" name="hash" value="e1ffad1a8de4f465a82d5a3650f5a3a268290b42d1b4d738b3193b7dcfd1d34dfd308a585906bac78dfab59255169bec9a136b0b7bb1a1a19d3792b9fe01cc39"/>
		                <input type="hidden" name="txnid" value="72f8d0e2247b76a91a7a" />
		                <div class="form-group">
		                    <label class="control-label">Total Payable Amount</label>
		                    <input class="form-control" name="amount" value="123"  readonly/>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Your Name</label>
		                    <input class="form-control" name="firstname" id="firstname" value="nmae" readonly/>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Email</label>
		                    <input class="form-control" name="email" id="email" value="a@mail.com" readonly/>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Phone</label>
		                    <input class="form-control" name="phone" value="9879879877" readonly />
		                </div>
		                <div class="form-group">
		                    <label class="control-label"> Booking Info</label>
		                    <textarea class="form-control" name="productinfo" readonly>something</textarea>
		                </div>
		                <div class="form-group">
		                    <label class="control-label">Address</label>
		                    <input class="form-control" name="address1" value="asdf" readonly/>     
		                </div>
		                <div class="form-group">
		                    <input name="surl" value="test.html" size="64" type="hidden" />
		                    <input name="furl" value="test.html" size="64" type="hidden" />  
		                    <!--for test environment comment  service provider   -->
		                    <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
		                    <input name="curl" value="test.html " type="hidden" />
		                </div>
		                <div class="form-group float-right">
		                	<input type="submit" value="Pay Now" class="btn btn-success" />
		                </div>
		            </form> 