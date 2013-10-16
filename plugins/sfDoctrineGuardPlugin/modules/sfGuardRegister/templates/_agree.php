            <div class="sf_admin_form_row sf_admin_text tab_head">
              An Introduction to Best Buddies International
            </div>
            <div class="sf_admin_form_row sf_admin_text">

              <p>Best Buddies is a 501(c) (3) non-profit organization whose mission is to establish a global volunteer movement that creates opportunities for one-to-one friendships, integrated employment and leadership development for people with intellectual and developmental disabilities (IDD). By joining Best Buddies International, you become part of a growing movement of people with and without IDD dedicated to ensuring everyone has the opportunity to have a friend. Socialization is one of the simplest, but most often underestimated, solutions to the pattern of exclusion that people with IDD have faced for decades.</p>

              <p>You will be joining an organization that will positively impact more than 700,000 individuals this year. Best Buddies accomplishes its mission through seven unique programs: Best Buddies Middle Schools, High Schools, Colleges, Citizens, Jobs, e-Buddies, and Ambassadors. Best Buddies programs engage participants in each of the 50 United States and operate accredited international programs in more than 50 countries.</p>

              <p>Best Buddies High Schools, Colleges, and Middle Schools are the foundation of the organization with chapters at more than 1,500 campuses around the world. Best Buddies Citizens matches adults with and without IDD in one-to-one friendships. Best Buddies Jobs, our supported employment program, helps people with IDD find and keep well paying jobs. e-Buddies matches individuals with and without IDD in online friendships. Ambassadors educates and empowers people with IDD to be leaders and public speakers in their schools, communities, and workplaces, and is the next step for the disability rights movement – teaching people with IDD the skills they need to successfully self-advocate.</p>

              <p>We encourage you to learn more about Best Buddies by visiting our website: www.bestbuddies.org, and on behalf of the 700,000 participants in Best Buddies, we thank you for your support.</p>
            </div>
            <div class="sf_admin_form_row sf_admin_text tab_head">
              Consent
            </div>
            <div class="sf_admin_form_row sf_admin_text">
              <ul>
                <li>I understand that I will be matched in a one-to-one friendship that includes seeing his or her Buddy twice a month and contacting him/her weekly during the school year, attend group activities, and participate in Best Buddies activities.</li>
                <li>I give permission to be photographed and/or filmed at any Best Buddies activity, and I understand that any photograph or videotape may be used at the discretion of Best Buddies for publicity purposes. DECLINE</li>
                <li>Prior to the commencement of my participation, I will furnish Best Buddies with any medical information that may be necessary in treating me in the case of an emergency.</li>
                <li>I consent to Best Buddies use and the disclosure of such medical information to medical professionals that may need the information in order to treat me in the case of an emergency.</li>
              </ul>
              <p>In consideration of the benefits and opportunities afforded to me through participation in the Best Buddies organization, the undersigned participant states as follows:</p>
              <ol>
                <li>I hereby agree to release Best Buddies International, Inc., from any liability for any accident, injury, or illness suffered at, during, or in connection with any Best Buddies activities, except for any accident, injury, or illness which results from gross misconduct by Best Buddies International, Inc., or its staff.</li>
                <li>I authorize Best Buddies International, Inc., to obtain medical treatment in the event of injury or illness in connection with a Best Buddies activity and agree to pay any expense incurred for treatment.</li>
                <li>I understand that, in connection with any Best Buddies activity, if I am riding in a private passenger automobile which is involved in an accident, I may be primarily covered for bodily injury under my family automobile policy, and I agree to submit any medical bills incurred to my insurance company for payment. If my policy has been issued with a deductible clause relative to the personal injury protection, I understand that I have assumed that deductible on primary coverage.</li>
                <li>If I am being transported in a commercial carrier or other leased or rented vehicles in connection with a Best Buddies activity and an injury occurs, I understand that I shall look to the commercial carrier or owner of the leased or rented vehicle to pay any medical bills incurred as a result of such injury.</li>
              </ol>
              <p>NOTE: The undersigned agrees to assume all risk of accident, injury, or illness that may occur at, during, or in connection with any Best Buddies activity.</p>
            </div>
            <div class="sf_admin_form_row">
              <div>
                <label style="width: 1%;">&nbsp;</label>
                <div class="content" style="width: 95%;">
                  Participant Consent<br />
                  <input type="checkbox" value="1" name="subform[nogroup_4][80_7][]" id="subform_nogroup_4_80_7_1" class="required" error_msg="You must click agree to participate in Best Buddies International" />I, <span class="agree_name"></span> agree to participate in Best Buddies International, Inc. for the academic year <span id="academic_year"></span>.
                </div>
              </div>
            </div>
            <div class="sf_admin_form_row sf_admin_text">
                <?php echo $sub_form['captcha']->renderError(); ?>
                <div></div>
                <div>
                    <?php echo $sub_form['captcha']->renderLabel(); ?>
                    <div class="content">
                        <?php echo $sub_form['captcha']->render(); ?>
                    </div>
                </div>
            </div>
            <div class="sf_admin_form_row sf_admin_text">
              <div>
                <label>&nbsp;</label>
                <div class="content">
                  <a class="open-tab" href="#tabs-<?php echo $i-1; ?>">Back</a>
                  <input type="submit" name="register" value="<?php echo __('I agree', null, 'sf_guard') ?>" onclick="return validateForm();" />
                </div>
              </div>
            </div>
        