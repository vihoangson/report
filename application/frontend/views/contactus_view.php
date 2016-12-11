<?php

echo'
<section class="col-main col-sm-9 wow bounceInUp animated animated" style="visibility: visible;">
<form action="'.base_url().'index.php/contactus/sendmail" method="post">
          <div class="static-contain">
            <fieldset class="group-select">
              <ul>
                <li id="billing-new-address-form">
                  <fieldset>
                    <legend>New Address</legend>
                    <input type="hidden" name="billing[address_id]" value="" id="billing:address_id">
                    <ul>
                      <li>
                        <div class="customer-name">
                          <div class="input-box name-firstname">
                            <label for="billing:firstname"> '.lang('_CNAME').'<span class="required">*</span></label>
                            <br>
                            <input type="text" id="billing:firstname" name="billing[firstname]" value="" title="First Name" class="input-text ">
                          </div>
                          <div class="input-box name-lastname">
                            <label for="billing:lastname"> '.lang('_CEMAIL').' <span class="required">*</span> </label>
                            <br>
                            <input type="text" id="billing:lastname" name="billing[email]" value="" title="Last Name" class="input-text">
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="input-box">
                          <label for="billing:company">'.lang('_CCOMPANY').'</label>
                          <br>
                          <input type="text" id="billing:company" name="billing[company]" value="" title="Company" class="input-text">
                        </div>
                        <div class="input-box">
                          <label for="billing:email">'.lang('_CPHONE').' <span class="required">*</span></label>
                          <br>
                          <input type="text" name="billing[phone]" id="billing:email" value="" title="Email Address" class="input-text validate-email">
                        </div>
                      </li>
                      <li>
                        <label for="billing:street1">'.lang('_CADDRESS').' <span class="required">*</span></label>
                        <br>
                        <input type="text" title="Street Address" name="billing[street][]" id="billing:street1" value="" class="input-text required-entry">
                      </li>
                      <li>
                        <input type="text" title="Street Address 2" name="billing[street][]" id="billing:street2" value="" class="input-text required-entry">
                      </li>
                      <li class="">
                        <label for="comment">'.lang('_CCOMMENT').'<em class="required">*</em></label>
                        <br>
                        <div class="">
                          <textarea name="comment" id="comment" title="Comment" class="required-entry input-text" cols="5" rows="3"></textarea>
                        </div>
                      </li>
                    </ul>
                  </fieldset>
                </li>
                <li>
                <p class="require"><em class="required">* </em>'.lang('_CREQUIRE').'</p>
                <input type="text" name="hideit" id="hideit" value="">
                <div class="buttons-set">
                  <button type="submit" title="Submit" class="button submit"> <span> '.lang('_CSUBMIT').' </span> </button>
                </div>
                </li>
              </ul>
            </fieldset>
          </div>
		</form>
        </section>';
if(sizeof($contactus))
{
$row = $contactus[0];
$title 		= $row['title'];
$hometext 	= $row['hometext'];
$bodytext 	= $row['bodytext'];
echo'<div>
	<h3>'.$title.'</h3>
	<p>'.$hometext.'</p>
	<p>'.$bodytext.'</p>
</div>';
}
?>