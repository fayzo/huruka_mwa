
<div class="card mt-3  col-sm-12 col-md-8 offset-md-2">
    <div class="card-header text-center px-0">
        <input style="float: right" type="button" class="btn btn-sm btn-success" id="addPostsjobs" value="Post jobs">
        <input style="float: left" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#examplePost" value="Example jobs">
        <h5 style="clear: left"><i>Jobs Description</i></h5>
    </div>
    <div class="card-body" style="overflow:auto">

  <?php if ($jobs['business_id'] == $user['user_id'] && $_SESSION['key'] == $jobs['business_id']) { ?>
             <div class="row">

              <div class="col-md-6">
                       <h6 class="text-center"><i> Jobs Turn <span class="bg-success rounded text-white px-1">On</span></i></h6>
                      <table class="table table-striped table-bordered table-hover table-jobsFetchOn" >
                        <thead class="main-active">
                             <tr>
                                 <td>ID</td>
                                 <td>jobs-title</td>
                                 <td>Created 0n</td>
                                 <td>Options</td>
                             </tr>
                         </thead>
                         <tbody id="tbody-jobsFetchOn">
                         </tbody>
                     </table>
              </div>

              <div class="col-md-6">
       
                <h6 class="text-center"><i> Jobs Turn <span class="bg-danger rounded text-white px-1">Off</span></i></h6>
                <table class="table table-striped table-bordered table-hover table-jobsFetch" >
                  <thead class="main-active">
                       <tr>
                           <td>ID</td>
                           <td>jobs-title</td>
                           <td>Created 0n</td>
                           <td>Options</td>
                       </tr>
                   </thead>
                   <tbody id="tbody-jobsFetch">
                   </tbody>
               </table>
               
              </div><!-- col -->

            </div><!-- row -->
        
    <?php }else{ ?>  

     <div class="card mt-3 col-12">
       <div class="card-body">

          <h4 class="card-title">Job Title: </h4>
          <p class="card-title">Explaination of Title: </p>
          <p>Make your job titles specific. Targeted job titles are more effective than generic ones, so be precise by including key phrases that accurately describe the role.
                 Avoid internal lingo that may confuse the job seeker. Stick to standard experience levels like “Senior” rather than “VI” or other terms people are less likely to look for.
          </p>
          <label for="">Examples of Data Analyst job titles </label>
          <ul style="list-style-type:dot">
             <li>Data Analyst</li>
             <li>Senior Data Analyst</li>
             <li>Clinical Data Analyst</li>
             <li>Data Analyst (Part-Time)</li>
             <li>Quantitative Analyst</li>
          </ul>
        <hr>

          <h4 class="card-title">Job Summary: </h4>
          <p class="card-title">Explaination of Job Summary: </p>
          <p>Open with a strong, attention-grabbing summary. Your summary should provide an overview of your company and expectations for the position.
                  Hook your reader with details about what makes your company unique. Your job description is an introduction to your company and your employer brand. Include details about your company culture to sum up why a candidate would love to work for you.
                  Include an exact job location. Provide an exact job location to optimize your job posting so it appears higher in job search results.
          </p>
          <p class="card-text">Example of a Data Analyst job summary. </p>
          <ul style="list-style-type:dot">
             <li>Our growing technology firm is looking for an experienced Data Analyst who is able to turn project requirements into custom-formatted data reports. The ideal candidate for this position is able to do complete life cycle data generation and outline critical information for each Project Manager. We also need someone who is able to analyze business procedures and recommend specific types of data that can be used to improve upon them. </li>
          </ul>
        <hr>

          <h4 class="card-title">Responsibilities and Duties: </h4>
          <p class="card-title">Explaination of Responsibilities: </p>
          <p>Outline the core responsibilities of the position. Make sure your list of responsibilities is detailed but concise. Also emphasize the duties that may be unique to your organization. For example, if you are hiring for an “Event Management” role and the position requires social media expertise to promote events, include this detail to ensure candidates understand the requirements and can determine if they’re qualified.
              Highlight the day-to-day activities of the position. This will help candidates understand the work environment and the activities they will be exposed to on a daily basis. This level of detail will help the candidate determine if the role and company are a right fit, helping you attract the best candidates for your position.
              Specify how the position fits into the organization. Indicate who the job reports to and how the person will function within your organization, helping candidates see the bigger picture and understand how the role impacts the business.
          </p>
          <p class="card-text">Examples of Data Analyst responsibilities. </p>
          <ul style="list-style-type:dot">
                 <li>Use statistical methods to analyze data and generate useful business reports</li>
                 <li>Work with management team to create a prioritized list of needs for each business segment</li>
                 <li>Identify and recommend new ways to save money by streamlining business processes</li>
                 <li>Use data to create models that depict trends in the customer base and the consumer population as a whole</li>
                 <li>Work with departmental managers to outline the specific data needs for each business method analysis project</li>
          </ul>
        <hr>

          <h4 class="card-title">Qualifications and Skills: </h4>
          <p class="card-title">Explaination of Qualifications and Skills: </p>
          <p>Include a list of hard and soft skills. Of course, the job description should specify education, previous job experience, certifications and technical skills required for the role. You may also include soft skills, like communication and problem solving, as well as personality traits that you envision for a successful hire.
                 Keep your list concise. While you may be tempted to list out every requirement you envision for your ideal hire, including too many qualifications and skills could dissuade potential candidates.         
          </p>
          <p class="card-text">Examples of Data Analyst skills. </p>
          <ul style="list-style-type:dot">
                 <li>Bachelor’s Degree in Mathematics or Computer Engineering</li>
                 <li>2+ years’ Data mining experience</li>
                 <li>3+ years in a data analyst role</li>
                 <li>Ability to collaborate effectively and work as part of a team</li>
                 <li>Strong attention to detail </li>
          </ul>
        <hr>

          <h4 class="card-title">Terms and conditions: </h4>
          <p class="card-title">Explaination of Terms and conditions: </p>
          <p>Include a list of hard and soft skills. Of course, the job description should specify education, previous job experience, certifications and technical skills required for the role. You may also include soft skills, like communication and problem solving, as well as personality traits that you envision for a successful hire.
                 Keep your list concise. While you may be tempted to list out every requirement you envision for your ideal hire, including too many qualifications and skills could dissuade potential candidates.         
          </p>
          <p class="card-text">Examples of Terms and conditions. </p>
          <ul style="list-style-type:dot">
                 <li>Bachelor’s Degree in Mathematics or Computer Engineering</li>
                 <li>2+ years’ Data mining experience</li>
                 <li>3+ years in a data analyst role</li>
                 <li>Ability to collaborate effectively and work as part of a team</li>
                 <li>Strong attention to detail </li>
          </ul>
        <hr>

          <h4 class="card-title">Deadline to submit: </h4>
          <p class="card-title">Explaination of Deadline to submit: </p>
          <p>Include a list of hard and soft skills. Of course, the job description should specify education, previous job experience, certifications and technical skills required for the role. You may also include soft skills, like communication and problem solving, as well as personality traits that you envision for a successful hire.
                 Keep your list concise. While you may be tempted to list out every requirement you envision for your ideal hire, including too many qualifications and skills could dissuade potential candidates.         
          </p>
          <p class="card-text">Examples of Deadline to submit. </p>
          <ul style="list-style-type:dot">
                 <li>Bachelor’s Degree in Mathematics or Computer Engineering</li>
                 <li>2+ years’ Data mining experience</li>
                 <li>3+ years in a data analyst role</li>
                 <li>Ability to collaborate effectively and work as part of a team</li>
                 <li>Strong attention to detail </li>
          </ul>
        <hr>

          <h4 class="card-title">Apply to website: </h4>
          <p class="card-title">Explaination of Apply to website: </p>
          <p>Include a list of hard and soft skills. Of course, the job description should specify education, previous job experience, certifications and technical skills required for the role. You may also include soft skills, like communication and problem solving, as well as personality traits that you envision for a successful hire.
                 Keep your list concise. While you may be tempted to list out every requirement you envision for your ideal hire, including too many qualifications and skills could dissuade potential candidates.         
          </p>
          <p class="card-text">Examples of Apply to website. </p>
          <ul style="list-style-type:dot">
                 <li>Bachelor’s Degree in Mathematics or Computer Engineering</li>
                 <li>2+ years’ Data mining experience</li>
                 <li>3+ years in a data analyst role</li>
                 <li>Ability to collaborate effectively and work as part of a team</li>
                 <li>Strong attention to detail </li>
          </ul>
        <hr>
        
      </div>
  </div>
    <?php } ?>

</div><!-- card-body -->
</div><!-- card -->

             <div id="Postjobs" class="modal fade">
             <div class="modal-dialog" style="max-width: 800px;margin: 1.75rem auto;position: relative;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                      <h4><i>Jobs To Posts</i> </h4>
                      <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                       <div class="modal-body">
                         <div class="edit-body">
                           <span id="responseBusinessJobs"></span>
                           <form method="post">
                             <!-- <input type="hidden" id="editor1" value="0"> -->
                             <input type="hidden" id="id_posts" value="0">
                             <input type="hidden" id="businessID_posts" value="<?php echo $_SESSION['key'] ;?>">
                               
                              <div class="form-group">
                                    <select class="form-control" name="categories_jobs" id="categories_jobs">
                                      <option class="categories_jobsx" value="">Select what types of jobs</option>
                                      <option value="Featured">Featured</option>
                                      <option value="Tenders">Tenders</option>
                                      <option value="Consultancy">Consultancy</option>
                                      <option value="Internships">Internships</option>
                                      <option value="Public">Public</option>
                                      <option value="Training">Training</option>
                                    </select>
                              </div>

                               <div class="form-group">
                                   <label for="jobs title">Job Title</label>
                                   <input type="text" class="form-control  job-title" placeholder="job-title">
                               </div>
                               <div class="form-group">
                                   <label for="Job Summary">Job Summary</label>
                                   <textarea class="form-control job-summary" id="editor4" rows="4"  placeholder="job summary"></textarea>
                               </div>
                               <div class="form-group">
                                    <label for="Pages Body">Deadline to submit</label>
                                    <input type="date" class="form-control deadline" placeholder="Deadline to submit">
                               </div>
                               <div class="form-group">
                                   <label for="Pages Body">Apply to website</label>
                                   <input class="form-control website" id="editor6" placeholder="website" >
                               </div>
                               <div class="form-check">
                                   <label class="form-check-label">
                                       <input type="checkbox" class="form-check-input"   value="checkedValue" checked>
                                       Publish
                                   </label>
                               </div>
                          </form>  
                          </div> <!-- edit-body END -->

                          <div class="view-body">

                          <div style="float:right">
                              <h4>categories_jobs: </h4>
                              <p class="categories_jobs0">Examples of an Accountant Responsibilities. </p>
                          </div>

                           <h4 >Job Title: </h4>
                            <label class="job-title0">Examples of Accountant job titles </label>
                          <hr>
                      
                             <h4 >Job Summary: </h4>
                             <p class="job-summary0"> Example of an Accountant job summary. </p>
                           <hr>
                      
                            <h4 class="card-title">Deadline to submit: </h4>
                            <p class="card-title deadlin0e">Explaination of Deadline to submit: </p>
                          <hr>
                  
                            <h4 class="card-title">Apply to website: </h4>
                            <p class="card-title website0">Explaination of Apply to website: </p>
                          <hr>
                         </div><!-- THiS IS A vIew body --> 
                       </div> <!-- THiS IS A MODAL BODY -->
                       <div class="modal-footer">
                           <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                           <input type="button" id="posts" value="Save" onclick="ajax_requestsPosts('create');" class="btn btn-success">
                       </div><!-- THiS IS A MODAL FOOTER -->
                  </div><!-- THiS IS A MODAL CONTENT -->
                </div><!-- THiS IS A MODAL DIALOG -->
            </div><!-- THiS IS A MODAL FADE -->



             <div id="addPostjobs" class="modal fade">
              <!-- <div style="max-width: 800px;margin: 1.75rem auto;position: relative;"> -->
              <div class="modal-dialog" style="max-width: 800px;margin: 1.75rem auto;position: relative;">
                <div class="modal-content">
                    <!-- <form method="post" id="form1" action='< ?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' enctype="multipart/form-data" > -->
                  <form method="post" id="form1" >
                    <div class="modal-header text-center">
                      <h4><i>Jobs To Posts</i> </h4>
                      <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                        <div class="modal-body">
                         <span id="responseBusinessJobs1"></span>
                             <!-- <input type="hidden" name="key" value="create"> -->
                             <input type="hidden" id="id_posts1" name="id_posts1" value="0">
                             <input type="hidden" id="businessID_posts1" name="businessID_posts1" value="<?php echo $_SESSION['key'] ;?>">
                                   
                              <div class="form-group">
                                    <select class="form-control" name="categories_jobs1" id="categories_jobs1">
                                      <option value="">Select what types of Posts</option>
                                      <option value="Featured">Jobs</option>
                                      <option value="Tenders">Tenders</option>
                                      <option value="Consultancy">Consultancy</option>
                                      <option value="Internships">Internships</option>
                                      <option value="Public">Public job as goverment</option>
                                      <option value="Training">To Training</option>
                                    </select>
                              </div>

                              <div class="form-group">
                                   <label for="jobs title">Job Title</label>
                                   <input type="text" name="job-title1" class="form-control job-title1"  placeholder="job title">
                               </div>
                               <div class="form-group">
                                   <label for="Job Summary">Job Summary</label>
                                   <textarea id="editor1" name="editor1" class="job-summary1" rows="10" cols="80">
                                    </textarea>
                               </div>
                               <div class="form-group">
                                   <label for="Pages Body">Deadline to submit</label>
                                    <input type="date" name="deadline1" class="form-control deadline1" placeholder="Deadline to submit">
                                   <!-- <textarea class="form-control textarea deadline1" id="editor11" placeholder="Deadline to submit"  rows="4"></textarea> -->
                               </div>
                               <div class="form-group">
                                   <label for="Pages Body">Apply to website or to this site</label>
                                   <textarea name="website1" class="form-control website1" id="editor12" placeholder="website" ></textarea>
                               </div>
                               <div class="form-check">
                                   <label class="form-check-label">
                                       <input type="checkbox" class="form-check-input"   value="checkedValue" checked>
                                       Publish
                                   </label>
                               </div>
                       </div> <!-- THiS IS A MODAL BODY -->
                       <div class="modal-footer">
                           <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                           <input type="button" id="addposts" value="Save" class="btn btn-success">
                       </div><!-- THiS IS A MODAL FOOTER -->
                       </form>  
                  </div><!-- THiS IS A MODAL CONTENT -->
                </div><!-- THiS IS A MODAL DIALOG -->
            </div><!-- THiS IS A MODAL FADE -->


             <div id="examplePost" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <h4><i> Posts jobs </i> </h4>
                      <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                      <div class="modal-body">
                           <h4 >Job Title: </h4>
                            <label for="">Examples of Accountant job titles </label>
                            <ul style="list-style-type:dot">
                               <li> Accountant</li>
                               <li>Entry-level Accountant/Bookkeeper </li>
                               <li>Accounts Payable Specialist</li>
                               <li>Payroll and Collections Accountant </li>
                               <li>Senior Staff Accountant  </li>
                            </ul>
                          <hr>
                      
                             <h4 >Job Summary: </h4>
                             <p> Example of an Accountant job summary. </p>
                             <ul style="list-style-type:dot">
                                <li>We’re looking for an organized and driven Staff Accountant to join our growing team at our company. The Staff Accountant position will work closely with our other accountants and operations personnel and handle day-to-day bookkeeping. We’re an energetic company and are looking for a passionate individual to join our organization and revitalize our record keeping and bring more organization to our day to day financials.</li>
                             </ul>
                           <hr>
                      
                             <h4>Responsibilities and Duties: </h4>
                             <p >Examples of an Accountant Responsibilities. </p>
                             <ul style="list-style-type:dot">
                                 <li>Perform monthly, quarterly and annual accounting activities including reconciliations of bank and credit card accounts, coordination and completion of annual audits, and reviewing financial reports/support as necessary</li>
                                 <li> Analyze and report on financial status including income statement variances, communicating financial results to management, budget preparation and analysis</li>
                                 <li> Improve systems and procedures and initiate corrective actions</li>
                                 <li> Oversee taxes and abide by federal regulations</li>
                             </ul>
                           <hr>
                      
                           <h4 >Qualifications and Skills: </h4>
                           <p >Examples of an Accountant skills. </p>
                           <ul style="list-style-type:dot">
                               <li>2+ years accounting experience</li>
                               <li>Expertise with QuickBooks</li>
                               <li>Extensive knowledge of US GAAP</li>
                               <li>Advanced computer skills in MS Office, accounting software and databases</li>
                               <li>Excellent organizational, problem-solving, project management and communication skills</li>
                               <li>Additional experience in Audit and International accounting</li>
                               <li>Experience with SaaS companies</li>
                               <li>CPA certification  </li>
                           </ul>
                         <hr>
                            <h4 class="card-title">Terms and conditions: </h4>
                            <p class="card-title">Explaination of Terms and conditions: </p>
                            <p>Include a list of hard and soft skills. Of course, the job description should specify education, previous job experience, certifications and technical skills required for the role. You may also include soft skills, like communication and problem solving, as well as personality traits that you envision for a successful hire.
                                   Keep your list concise. While you may be tempted to list out every requirement you envision for your ideal hire, including too many qualifications and skills could dissuade potential candidates.         
                            </p>
                            <p class="card-text">Examples of Terms and conditions. </p>
                            <ul style="list-style-type:dot">
                                   <li>Bachelor’s Degree in Mathematics or Computer Engineering</li>
                                   <li>2+ years’ Data mining experience</li>
                                   <li>3+ years in a data analyst role</li>
                                   <li>Ability to collaborate effectively and work as part of a team</li>
                                   <li>Strong attention to detail </li>
                            </ul>
                          <hr>
                  
                            <h4 class="card-title">Deadline to submit: </h4>
                            <p class="card-title">Explaination of Deadline to submit: </p>
                            <p>Include a list of hard and soft skills. Of course, the job description should specify education, previous job experience, certifications and technical skills required for the role. You may also include soft skills, like communication and problem solving, as well as personality traits that you envision for a successful hire.
                                   Keep your list concise. While you may be tempted to list out every requirement you envision for your ideal hire, including too many qualifications and skills could dissuade potential candidates.         
                            </p>
                            <p class="card-text">Examples of Deadline to submit. </p>
                            <ul style="list-style-type:dot">
                                   <li>Bachelor’s Degree in Mathematics or Computer Engineering</li>
                                   <li>2+ years’ Data mining experience</li>
                                   <li>3+ years in a data analyst role</li>
                                   <li>Ability to collaborate effectively and work as part of a team</li>
                                   <li>Strong attention to detail </li>
                            </ul>
                          <hr>
                  
                            <h4 class="card-title">Apply to website: </h4>
                            <p class="card-title">Explaination of Apply to website: </p>
                            <p>Include a list of hard and soft skills. Of course, the job description should specify education, previous job experience, certifications and technical skills required for the role. You may also include soft skills, like communication and problem solving, as well as personality traits that you envision for a successful hire.
                                   Keep your list concise. While you may be tempted to list out every requirement you envision for your ideal hire, including too many qualifications and skills could dissuade potential candidates.         
                            </p>
                            <p class="card-text">Examples of Apply to website. </p>
                            <ul style="list-style-type:dot">
                                   <li>Bachelor’s Degree in Mathematics or Computer Engineering</li>
                                   <li>2+ years’ Data mining experience</li>
                                   <li>3+ years in a data analyst role</li>
                                   <li>Ability to collaborate effectively and work as part of a team</li>
                                   <li>Strong attention to detail </li>
                            </ul>
                          <hr>
                       </div><!-- THiS IS A MODAL body -->
                       <div class="modal-footer">
                         <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                       </div>
                    </div><!-- THiS IS A MODAL CONTENT -->
                  </div><!-- THiS IS A MODAL DIALOG -->
               </div><!-- THiS IS A MODAL FADE -->

     



