<?php
error_reporting(0);
require_once 'includes/header.php';
if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'PrivacyPolicy'){
    $data = $fn->GetPrivacyData();
    $DisplayTitle = $data['GetPrivacyWiseData']['DocumentTitle'];
    $DisplayData = $data['GetPrivacyWiseData']['DocumentDescription'];
    $DisplayImage = '';
}else if(isset($_REQUEST['Type']) && $_REQUEST['Type'] =='TermsCondition'){
    $data = $fn->GetTermsConditionData();
    $DisplayTitle = $data['GetTermsConditionWiseData']['DocumentTitle'];
    $DisplayData = $data['GetTermsConditionWiseData']['DocumentDescription'];
    $DisplayImage = '';
}else if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'UserAgreement'){
    $data = $fn->GetUserAgreementData();
    $DisplayTitle = $data['GetUserAgreementWiseData']['DocumentTitle'];
    $DisplayData = $data['GetUserAgreementWiseData']['DocumentDescription'];
    $DisplayImage = '';
}else if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'PaymentAgreement'){
    $data = $fn->GetPaymentAgreementData();
    $DisplayTitle = $data['GetPaymentAgreementWiseData']['DocumentTitle'];
    $DisplayData = $data['GetPaymentAgreementWiseData']['DocumentDescription'];
    $DisplayImage = '';
}else if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'HowItWorks'){
    $data = $fn->GetHowItWorksData();
    $DisplayTitle = $data['GetHowItWorksWiseData']['DocumentTitle'];
    $DisplayData = $data['GetHowItWorksWiseData']['DocumentDescription'];
    $DisplayImage = '';
}else if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'SubstitutionalRules'){
    $data = $fn->GetSubstitutionRulesData();
    $DisplayTitle = $data['GetSubstitutionRulesWiseData']['DocumentTitle'];
    $DisplayData = $data['GetSubstitutionRulesWiseData']['DocumentDescription'];
    $DisplayImage = '';
}else if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'MatchRules'){
    $data = $fn->GetMatchRulesData();
    $DisplayTitle = $data['GetMatchRulesWiseData']['DocumentTitle'];
    $DisplayData = $data['GetMatchRulesWiseData']['DocumentDescription'];
    $DisplayImage = '';
}else if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'TournamentRules'){
    $data = $fn->GetTournamentRulesData();
    $DisplayTitle = $data['GetTournamentRulesWiseData']['DocumentTitle'];
    $DisplayData = $data['GetTournamentRulesWiseData']['DocumentDescription'];
    $DisplayImage = '';
}
?>
    <!--========================================== 
          ==Start contact container==
    ========================================== -->
    <div class="contact-container">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="section-title inner-page">
                        <h2><?php echo $DisplayTitle; ?> </h2>
                        <span class="section-style"></span>
                    </div>
                    <div class="office-info">
                        <ul>
                            <li>
                                <p>
                                   <?php echo $DisplayData?>
                                </p>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="section-title inner-page"></div>
                    <br>
                   <img src="admin/image/New/" class="img-thumbnail" style="min-height:300px;max-height: 500px;"> 
                </div>
            </div>
        </div>
    </div>
    <!--========================================== 
          ==Start contact container==
    ========================================== -->
<?php
include 'includes/footer.php'
?>