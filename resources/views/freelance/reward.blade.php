@extends('freelance.main')

@section('content')
<style>
   .walet_card .card {
   background: white;
   width: 50%;
   border-radius: 20px;
   box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
   padding: 24px 20px 28px;
   text-align: center;
   position: relative;
   border: 0px;
   margin-left: 25%;
   margin-top: 40px;
   margin-bottom: 30px;
   }
   .walet_card  .icon {
   width: 64px;
   height: 64px;
   background: #f9c74f;
   border-radius: 50%;
   display: flex;
   justify-content: center;
   align-items: center;
   position: absolute;
   top: -32px;
   left: 50%;
   transform: translateX(-50%);
   box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
   }
   .walet_card .card h2 {
   margin-top: 40px;
   margin-bottom: 4px;
   color: #393669;
   font-size: 40px;
   }
   .walet_card .card p {
   margin: 0;
   font-size: 18px;
   color: #666;
   }
   .walet_card .progress-section {
   margin-top: 20px;
   background: #f7f7f7;
   border-radius: 10px;
   padding: 14px;
   text-align: left;
   }
   .walet_card .progress-title {
   font-size: 18px;
   color: #333;
   margin-bottom: 6px;
   }
   .walet_card .progress-bar {
   background: #ddd;
   height: 10px;
   border-radius: 5px;
   overflow: hidden;
   }
   .walet_card .progress-fill {
   width: 100%;
   height: 10px;
   background: #393669;
   }
   .walet_card .progress-count {
   text-align: right;
   font-size: 22px;
   font-weight: bold;
   color: #393669;
   margin-top: 15px;
   margin-bottom: 10px;
   }
   .walet_card .message {
   margin-top: 20px;
   background: #d1f7cc;
   padding: 30px 20px;
   border-radius: 10px;
   color: #1b5e20;
   font-size: 18px;
   font-weight: 500;
   }
   .walet_card .icon {
   width: 104px;
   height: 104px;
   background: #f9c74f;
   border-radius: 50%;
   display: flex;
   justify-content: center;
   align-items: center;
   position: absolute;
   top: -57px;
   left: 50%;
   transform: translateX(-50%);
   box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
   }
   .rewrd_icon_s svg{
   width: 70px;
   height: auto;
   }
   .cong_div{
   font-size: 25px;
   float: left;
   width: 100%;
   text-align: center;
   margin-bottom: 5px;
   margin-top: -10px;
   }
</style>
<section class="pc-container">
   <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <!-- [ breadcrumb ] end -->
      <div class="row">
         <div class="col-sm-12 ">
            <div class="card">
               <div class="card-body walet_card">
                  <div class="card">
                     <!-- Award Icon -->
                     <div class="icon rewrd_icon_s">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon-tabler icons-tabler-outline icon-tabler-award">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                           <path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
                           <path d="M12 15l3.4 5.89l1.598 -3.233l3.598 .232l-3.4 -5.889" />
                           <path d="M6.802 12l-3.4 5.89l3.598 -.233l1.598 3.232l3.4 -5.889" />
                        </svg>
                     </div>
                     <!-- Title -->
                     <h2>Gift Voucher</h2>
                     <p>Your journey is complete!</p>
                     <!-- Member Progress -->
                     <div class="progress-section">
                        <div class="progress-title">Total Invited Members</div>
                        <div class="progress-bar">
                           <div class="progress-fill"></div>
                        </div>
                        <div class="progress-count">1,600 / 1,600</div>
                     </div>
                     <!-- Success Message -->
                     <div class="message">
                        <div class="cong_div">Congratulations!</div>
                        You've successfully invited 1,600 members.<br>Your reward is now unlocked!
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- [ Main Content ] end -->
   </div>
</section>
@endsection