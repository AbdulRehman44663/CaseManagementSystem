<div class="sidebar_div collapse show">
  <div class="sidebar bg_126C9B">
      <div class="text-center">
          <img src="<?=url('')?>/assets/images/logo.webp" alt="" class="sidebar_logo">
      </div>
      <a href="{{route('admin.dashboard')}}">
        <div class="d-flex align-items-center sidebar_item {{isset($sidebar_active) && $sidebar_active=='dashboard'?'active':''}}">
            <div class="item_icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_79_21252)">
                    <path d="M7.70828 0H1.45828C0.654144 0 0 0.654144 0 1.45828V5.20828C0 6.01257 0.654144 6.66672 1.45828 6.66672H7.70828C8.51257 6.66672 9.16672 6.01257 9.16672 5.20828V1.45828C9.16672 0.654144 8.51257 0 7.70828 0Z" fill="#ffffff"/>
                    <path d="M7.70828 8H1.45828C0.654144 8 0 8.65414 0 9.45844V18.2084C0 19.0126 0.654144 19.6667 1.45828 19.6667H7.70828C8.51257 19.6667 9.16672 19.0126 9.16672 18.2084V9.45844C9.16672 8.65414 8.51257 8 7.70828 8Z" fill="#ffffff"/>
                    <path d="M18.5417 13.3333H12.2917C11.4874 13.3333 10.8333 13.9874 10.8333 14.7917V18.5417C10.8333 19.3458 11.4874 20 12.2917 20H18.5417C19.3459 20 20 19.3458 20 18.5417V14.7917C20 13.9874 19.3459 13.3333 18.5417 13.3333Z" fill="#ffffff"/>
                    <path d="M18.5417 0H12.2917C11.4874 0 10.8333 0.654144 10.8333 1.45828V10.2083C10.8333 11.0126 11.4874 11.6667 12.2917 11.6667H18.5417C19.3459 11.6667 20 11.0126 20 10.2083V1.45828C20 0.654144 19.3459 0 18.5417 0Z" fill="#ffffff"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_79_21252">
                    <rect width="20" height="20" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
            </div>
            <div class="text_16_500 ff_dm_sans ml_12 item_title">Dashboard</div>
        </div>
      </a>
      <a href="{{route('admin.adminPanel')}}">
        <div class="d-flex align-items-center sidebar_item {{isset($sidebar_active) && $sidebar_active=='admin_panel'?'active':''}}">
            <div class="item_icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_79_21257)">
                      <path d="M18.96 7.9199L17.68 7.6799C17.52 7.1999 17.36 6.7199 17.04 6.2399L17.84 5.1999C18.08 4.8799 18 4.4799 17.76 4.1599L15.92 2.3199C15.68 2.0799 15.2 1.9999 14.88 2.2399L13.84 2.9599C13.36 2.7199 12.8 2.4799 12.24 2.3199L12 1.0399C11.92 0.639902 11.6 0.399902 11.2 0.399902H8.55999C8.15999 0.399902 7.83999 0.719902 7.75999 1.0399L7.59999 2.3199C7.11999 2.3999 6.55999 2.6399 6.07999 2.9599L5.11999 2.2399C4.79999 1.9999 4.39999 1.9999 4.07999 2.3199L2.23999 4.1599C1.99999 4.3999 1.91999 4.8799 2.15999 5.1999L2.87999 6.1599C2.55999 6.6399 2.39999 7.1999 2.23999 7.7599L1.03999 7.9199C0.639994 7.9999 0.399994 8.3199 0.399994 8.7199V11.3599C0.399994 11.7599 0.719994 12.0799 1.03999 12.1599L2.23999 12.3199C2.39999 12.8799 2.63999 13.3599 2.87999 13.9199L2.23999 14.8799C1.99999 15.1999 1.99999 15.5999 2.31999 15.9199L4.15999 17.7599C4.39999 17.9999 4.87999 18.0799 5.19999 17.8399L6.15999 17.1199C6.63999 17.3599 7.11999 17.5999 7.59999 17.7599L7.75999 18.9599C7.83999 19.3599 8.15999 19.5999 8.55999 19.5999H11.2C11.6 19.5999 11.92 19.2799 12 18.9599L12.16 17.7599C12.72 17.5999 13.2 17.3599 13.68 17.1199L14.72 17.8399C15.04 18.0799 15.52 17.9999 15.76 17.7599L17.6 15.9199C17.84 15.6799 17.92 15.1999 17.68 14.8799L16.96 13.8399C17.2 13.3599 17.44 12.8799 17.6 12.3999L18.88 12.1599C19.28 12.0799 19.52 11.7599 19.52 11.3599V8.7199C19.6 8.3199 19.28 7.9999 18.96 7.9199ZM14.64 13.7599C13.92 12.8799 13.04 12.2399 11.92 11.8399C11.76 11.7599 11.6 11.8399 11.52 11.8399C11.04 11.9999 10.56 12.1599 10.08 12.1599C9.59999 12.1599 9.03999 12.0799 8.63999 11.8399C8.47999 11.7599 8.31999 11.7599 8.23999 11.8399C7.11999 12.2399 6.15999 12.8799 5.51999 13.7599C4.71999 12.7199 4.23999 11.4399 4.23999 10.0799C4.23999 6.7999 6.87999 4.0799 10.24 4.0799C13.52 4.0799 16.16 6.7199 16.16 10.0799C15.92 11.4399 15.44 12.7199 14.64 13.7599Z" fill="white"/>
                      <path d="M10 6.07983C8.64001 6.07983 7.60001 7.19983 7.60001 8.47983C7.60001 9.83983 8.64001 10.8798 10 10.8798C11.28 10.8798 12.4 9.83983 12.4 8.47983C12.4 7.11983 11.36 6.07983 10 6.07983Z" fill="white"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_79_21257">
                        <rect width="20" height="20" fill="white"/>
                      </clipPath>
                    </defs>
                </svg>
            </div>
            <div class="text_16_500 ff_dm_sans ml_12 item_title">Admin Panel </div>
        </div>
      </a>
     
    
      <a href="{{route('admin.tasks')}}">
        <div class="d-flex align-items-center sidebar_item {{isset($sidebar_active) && $sidebar_active=='tasks'?'active':''}}">
            <div class="item_icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M17.1036 1.68742C16.7719 1.355 16.3307 1.17188 15.8613 1.17188H15.0822V1.95312C15.0822 2.81469 14.3821 3.51562 13.5214 3.51562H6.49801C5.63738 3.51562 4.93723 2.81469 4.93723 1.95312V1.17188H4.15555C3.18844 1.17188 2.40078 1.95953 2.39969 2.92773L2.38281 18.2402C2.38227 18.7101 2.56469 19.152 2.89637 19.4845C3.22813 19.8169 3.6693 20 4.13867 20H15.8444C16.8115 20 17.5992 19.2123 17.6003 18.2441L17.6172 2.93164C17.6177 2.46176 17.4353 2.01988 17.1036 1.68742ZM10.199 7.03125H14.3573C14.6805 7.03125 14.9426 7.29359 14.9426 7.61719C14.9426 7.94078 14.6805 8.20312 14.3573 8.20312H10.199C9.87574 8.20312 9.61371 7.94078 9.61371 7.61719C9.61371 7.29359 9.87574 7.03125 10.199 7.03125ZM10.199 10.9375H14.3573C14.6805 10.9375 14.9426 11.1998 14.9426 11.5234C14.9426 11.847 14.6805 12.1094 14.3573 12.1094H10.199C9.87574 12.1094 9.61371 11.847 9.61371 11.5234C9.61371 11.1998 9.87574 10.9375 10.199 10.9375ZM10.199 14.8438H14.374C14.6973 14.8438 14.9593 15.1061 14.9593 15.4297C14.9593 15.7533 14.6973 16.0156 14.374 16.0156H10.199C9.87574 16.0156 9.61371 15.7533 9.61371 15.4297C9.61371 15.1061 9.87574 14.8438 10.199 14.8438ZM5.21215 7.05437C5.44074 6.82555 5.81129 6.82555 6.03988 7.05437L6.35813 7.37301L7.70789 6.02176C7.93649 5.79297 8.30703 5.79289 8.53559 6.02176C8.76414 6.25055 8.76414 6.62156 8.53559 6.85039L6.77195 8.61594C6.66219 8.72582 6.51332 8.78758 6.35809 8.78758C6.20285 8.78758 6.05399 8.72586 5.94422 8.61594L5.21211 7.88297C4.98356 7.65418 4.98356 7.28316 5.21215 7.05437ZM5.21215 11.2589C5.44074 11.0301 5.81129 11.0301 6.03988 11.2589L6.35813 11.5775L7.70789 10.2263C7.93645 9.9975 8.30703 9.9975 8.53559 10.2263C8.76414 10.4551 8.76414 10.8261 8.53559 11.0549L6.77195 12.8205C6.66223 12.9304 6.51332 12.9921 6.35809 12.9921C6.20285 12.9921 6.05399 12.9304 5.94422 12.8205L5.21211 12.0875C4.98356 11.8588 4.98356 11.4878 5.21215 11.2589ZM5.21215 15.1652C5.44074 14.9364 5.81129 14.9364 6.03988 15.1652L6.35813 15.4838L7.70789 14.1325C7.93645 13.9038 8.30703 13.9038 8.53559 14.1325C8.76414 14.3613 8.76414 14.7323 8.53559 14.9612L6.77195 16.7268C6.66223 16.8366 6.51332 16.8984 6.35809 16.8984C6.20285 16.8984 6.05399 16.8367 5.94422 16.7268L5.21211 15.9938C4.98356 15.765 4.98356 15.394 5.21215 15.1652Z" fill="white"/>
                    <path d="M6.10785 1.95312C6.10785 2.16887 6.28254 2.34375 6.49804 2.34375H13.5215C13.737 2.34375 13.9117 2.16887 13.9117 1.95312V0.390625C13.9117 0.174883 13.737 0 13.5215 0H6.49804C6.28254 0 6.10785 0.174883 6.10785 0.390625V1.95312Z" fill="white"/>
                </svg>
            </div>
            <div class="text_16_500 ff_dm_sans ml_12 item_title">Tasks</div>
        </div>
      </a>
    
      <a href="{{route('admin.leads')}}">
        <div class="d-flex align-items-center sidebar_item {{isset($sidebar_active) && $sidebar_active=='leads'?'active':''}}">
            <div class="item_icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_79_21277)">
                      <path d="M4.69159 13.6511L0.171591 18.1711C-0.0572375 18.4 -0.0572375 18.7709 0.171591 18.9998L1.00022 19.8284C1.11011 19.9383 1.25913 20 1.41456 20C1.56995 20 1.71897 19.9383 1.8289 19.8284L6.3489 15.3084C5.70097 14.8614 5.13862 14.2991 4.69159 13.6511Z" fill="white"/>
                      <path d="M18.7401 16.0627C18.185 16.5672 17.4481 16.875 16.6406 16.875C15.9598 16.875 15.3121 16.6591 14.7677 16.2505C14.6892 16.1916 14.6139 16.1286 14.5414 16.0625C13.7967 16.6719 13.3203 17.5977 13.3203 18.6328V19.4141C13.3203 19.7377 13.5827 20 13.9062 20H19.375C19.6986 20 19.9609 19.7377 19.9609 19.4141V18.6328C19.9609 17.5978 19.4847 16.6721 18.7401 16.0627Z" fill="white"/>
                      <path d="M16.6406 15.7031C17.7176 15.7031 18.5937 14.827 18.5937 13.75C18.5937 12.673 17.7176 11.7969 16.6406 11.7969C16.4795 11.7969 16.323 11.8169 16.1731 11.8538C15.8936 12.7829 15.41 13.6244 14.7741 14.3255C15.0204 15.1225 15.7639 15.7031 16.6406 15.7031Z" fill="white"/>
                      <path d="M18.7792 4.26587C18.224 4.77032 17.4872 5.07813 16.6797 5.07813C15.8725 5.07813 15.1358 4.77048 14.5807 4.26634C14.3481 4.45688 14.1415 4.6781 13.9676 4.92407C15.0185 5.74731 15.8081 6.88935 16.1901 8.20313H19.4141C19.7377 8.20313 20 7.94079 20 7.6172V6.83595C20 5.80095 19.5238 4.87528 18.7792 4.26587Z" fill="white"/>
                      <path d="M1.22082 4.26587C0.476211 4.87524 0 5.80095 0 6.83595V7.6172C0 7.94079 0.262344 8.20313 0.585938 8.20313H3.80988C4.19187 6.88931 4.98148 5.74731 6.03242 4.92407C5.85852 4.6781 5.65191 4.45688 5.4193 4.26634C4.86418 4.77048 4.1275 5.07813 3.32031 5.07813C2.51289 5.07813 1.77602 4.77032 1.22082 4.26587Z" fill="white"/>
                      <path d="M3.32031 3.90625C2.24336 3.90625 1.36719 3.03008 1.36719 1.95312C1.36719 0.876172 2.2434 0 3.32031 0C4.39723 0 5.27344 0.876172 5.27344 1.95312C5.27344 3.03008 4.39727 3.90625 3.32031 3.90625Z" fill="white"/>
                      <path d="M16.6797 3.90625C15.6027 3.90625 14.7266 3.03008 14.7266 1.95312C14.7266 0.876172 15.6027 0 16.6797 0C17.7566 0 18.6328 0.876172 18.6328 1.95312C18.6328 3.03008 17.7566 3.90625 16.6797 3.90625Z" fill="white"/>
                      <path d="M7.85663 14.8178C8.51186 15.1104 9.23721 15.2734 9.99999 15.2734C10.7628 15.2734 11.4881 15.1104 12.1433 14.8178V13.8171C12.0961 12.6615 11.1565 11.7578 9.99999 11.7578C8.84346 11.7578 7.90389 12.6615 7.85663 13.8171V14.8178Z" fill="white"/>
                      <path d="M10 10.5859C10.6472 10.5859 11.1719 10.0613 11.1719 9.41406C11.1719 8.76685 10.6472 8.24219 10 8.24219C9.35279 8.24219 8.82812 8.76685 8.82812 9.41406C8.82812 10.0613 9.35279 10.5859 10 10.5859Z" fill="white"/>
                      <path d="M10 4.72656C7.09223 4.72656 4.72656 7.09223 4.72656 10C4.72656 11.6528 5.49105 13.1301 6.68477 14.0977V13.8058C6.68477 13.7987 6.68488 13.7916 6.68516 13.7845C6.71652 12.9234 7.07488 12.1189 7.69418 11.5192C7.88488 11.3345 8.09434 11.1756 8.31785 11.0436C7.90879 10.6215 7.65625 10.0469 7.65625 9.41406C7.65625 8.12172 8.70766 7.07031 10 7.07031C11.2923 7.07031 12.3438 8.12172 12.3438 9.41406C12.3438 10.0469 12.0912 10.6215 11.6822 11.0436C11.9057 11.1756 12.1151 11.3346 12.3058 11.5192C12.9251 12.1189 13.2834 12.9234 13.3148 13.7845C13.315 13.7916 13.3152 13.7988 13.3152 13.8059V14.0977C14.5089 13.1301 15.2734 11.6528 15.2734 10C15.2734 7.09223 12.9078 4.72656 10 4.72656Z" fill="white"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_79_21277">
                        <rect width="20" height="20" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
            </div>
            <div class="text_16_500 ff_dm_sans ml_12 item_title">Leads</div>
        </div>
      </a>
      <a href="{{route('admin.clientsList')}}">
        <div class="d-flex align-items-center sidebar_item {{isset($sidebar_active) && $sidebar_active=='clients_list'?'active':''}}">
            <div class="item_icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_79_21288)">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3251 7.77458C17.7524 7.45681 16.1798 7.61606 14.6072 8.25239C14.5107 8.29142 14.4618 8.39903 14.4959 8.49735L16.7172 14.9119C16.745 14.992 16.817 15.0433 16.9018 15.0433H19.3251V7.77458ZM5.7409 0.47583C6.5911 0.47583 7.28032 1.15657 7.28032 1.99634C7.28032 2.8361 6.5911 3.51685 5.7409 3.51685C4.89071 3.51685 4.20149 2.8361 4.20149 1.99634C4.20149 1.15657 4.89071 0.47583 5.7409 0.47583ZM10 1.5979C10.8502 1.5979 11.5394 2.27864 11.5394 3.11841C11.5394 3.95817 10.8502 4.63892 10 4.63892C9.14981 4.63892 8.46059 3.95817 8.46059 3.11841C8.46059 2.27864 9.14981 1.5979 10 1.5979ZM14.2591 0.47583C15.1093 0.47583 15.7986 1.15657 15.7986 1.99634C15.7986 2.8361 15.1093 3.51685 14.2591 3.51685C13.4089 3.51685 12.7197 2.8361 12.7197 1.99634C12.7197 1.15657 13.4089 0.47583 14.2591 0.47583ZM7.37688 11.5379C7.37688 11.2361 7.48219 10.9907 7.70219 10.7839L9.30903 9.27302C10.2446 8.39341 11.1088 8.56876 12.1995 8.91403C12.8352 9.11524 13.4536 9.31095 14.1735 9.35692L15.9291 14.4267C15.7173 14.5321 15.4996 14.6367 15.2628 14.7334C14.8646 14.8959 14.4434 14.8115 14.139 14.5074L10.6364 11.007C10.5263 10.8974 10.3506 10.8938 10.2362 10.9959C10.2361 10.9958 10.1191 11.093 10.1087 11.1014C9.74993 11.391 9.14864 11.8763 9.14864 12.6792C9.14864 13.1386 8.92575 13.5193 8.58657 13.7938C8.26008 14.0581 7.82793 14.2266 7.37688 14.278V11.5379ZM5.75911 9.55181C6.04247 9.62388 6.31789 9.67356 6.59278 9.70255C7.06473 9.75231 7.53032 9.74052 8.02727 9.67587L7.30164 10.3582C6.9684 10.6715 6.79094 11.0803 6.79094 11.5379V14.5877C6.79094 14.7495 6.92211 14.8807 7.08391 14.8807C7.76512 14.8807 8.45317 14.6534 8.95508 14.2471C9.42543 13.8663 9.73457 13.3317 9.73457 12.6792C9.73457 12.1928 10.133 11.8357 10.4115 11.6083L13.727 14.9217C13.886 15.0806 14.0687 15.2012 14.2651 15.2814C14.3988 15.4211 14.5321 15.5611 14.6655 15.7011C14.9021 15.9485 14.9165 16.3417 14.67 16.5882C14.4294 16.8288 14.0294 16.8288 13.7887 16.5882C13.1459 15.9454 12.5141 15.2874 11.8784 14.6361C11.7659 14.5204 11.5809 14.5178 11.4653 14.6303C11.3497 14.7428 11.3471 14.9278 11.4596 15.0434L13.2035 16.8315C13.4456 17.0735 13.4454 17.4707 13.2034 17.7127C12.9614 17.9547 12.5641 17.9548 12.3222 17.7128C11.6519 17.0425 10.9935 16.3586 10.3308 15.6796C10.2183 15.5639 10.0333 15.5614 9.91766 15.6739C9.802 15.7864 9.79942 15.9714 9.91196 16.087L11.6559 17.875C11.8966 18.1157 11.8966 18.5156 11.6559 18.7563C11.4233 18.9889 10.985 18.9667 10.7746 18.7563C10.0468 18.0285 9.33184 17.2895 8.61239 16.5523C8.49989 16.4366 8.31489 16.434 8.19926 16.5465C8.08364 16.659 8.08106 16.844 8.19356 16.9597L9.93743 18.7477C10.115 18.9253 10.1133 19.2187 9.93438 19.3944C9.76055 19.564 9.47453 19.57 9.30106 19.3966C9.29411 19.4035 6.43145 16.4573 6.17051 16.1899C5.50887 15.5121 4.9195 14.9104 4.0552 14.472L5.75911 9.55181ZM7.44379 7.81255H12.5562V6.58759C12.5562 5.76884 12.0976 5.05208 11.4247 4.68122C11.0466 5.01962 10.5459 5.22481 9.99996 5.22481C9.45399 5.22481 8.95336 5.01958 8.57528 4.68122C7.90235 5.05208 7.44375 5.76884 7.44375 6.58759V7.81255H7.44379ZM13.1421 6.69048V6.58759C13.1421 5.67489 12.6942 4.86278 12.0073 4.35958C12.2065 4.02489 12.4928 3.74747 12.8345 3.55919C13.2125 3.89759 13.7132 4.10278 14.2591 4.10278C14.8051 4.10278 15.3057 3.89759 15.6838 3.55919C16.3567 3.93001 16.8153 4.64681 16.8153 5.46552V6.69048H13.1421ZM3.18469 6.69048V5.46552C3.18469 4.64677 3.64325 3.93001 4.31622 3.55919C4.6943 3.89759 5.19493 4.10278 5.7409 4.10278C6.28688 4.10278 6.78747 3.89759 7.16555 3.55919C7.50715 3.74747 7.79352 4.02489 7.9927 4.35958C7.30579 4.86278 6.85789 5.67489 6.85789 6.58759V6.69048H3.18469ZM0.674927 7.77458V15.0433H3.09825C3.18297 15.0433 3.25508 14.992 3.28278 14.9119L5.50418 8.49739C5.53825 8.39903 5.48938 8.29145 5.3929 8.25243C3.82024 7.6161 2.24758 7.45681 0.674927 7.77458Z" fill="white"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_79_21288">
                        <rect width="20" height="20" fill="white"/>
                      </clipPath>
                    </defs>
                </svg>
            </div>
            <div class="text_16_500 ff_dm_sans ml_12 item_title">Clients List</div>
        </div>
      </a>
      {{-- <a href="{{route('admin.variables')}}">
        <div class="d-flex align-items-center sidebar_item {{isset($sidebar_active) && $sidebar_active=='variables'?'active':''}}">
            <div class="item_icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M2.8125 3.4375C3.67544 3.4375 4.375 2.73794 4.375 1.875C4.375 1.01206 3.67544 0.3125 2.8125 0.3125C1.94956 0.3125 1.25 1.01206 1.25 1.875C1.25 2.73794 1.94956 3.4375 2.8125 3.4375Z" fill="#126C9B"/>
              <path d="M10.9375 0.3125H14.0625V3.4375H10.9375V0.3125Z" fill="white"/>
              <path d="M15.625 3.4375H18.75L17.1875 0.3125L15.625 3.4375Z" fill="white"/>
              <path d="M6.5978 3.4375H8.40217L9.30405 1.875L8.40217 0.3125H6.5978L5.69592 1.875L6.5978 3.4375Z" fill="white"/>
              <path d="M9.0625 10.625V8.4375C9.06253 8.37943 9.04637 8.3225 9.01585 8.27309C8.98532 8.22369 8.94164 8.18377 8.88969 8.15781L7.8125 7.61937V5.625H7.1875V7.8125C7.18747 7.87057 7.20363 7.9275 7.23415 7.97691C7.26468 8.02631 7.30836 8.06623 7.36031 8.09219L8.4375 8.63063V10.625H9.0625Z" fill="white"/>
              <path d="M6.25 11.5625V10C6.25003 9.94193 6.23387 9.885 6.20335 9.83559C6.17282 9.78619 6.12914 9.74627 6.07719 9.72031L3.125 8.24437V5.625H2.5V8.4375C2.49997 8.49557 2.51613 8.5525 2.54665 8.60191C2.57718 8.65131 2.62086 8.69123 2.67281 8.71719L5.625 10.1931V11.5625H6.25Z" fill="white"/>
              <path d="M12.1875 7.61937L11.1103 8.15781C11.0584 8.18377 11.0147 8.22369 10.9842 8.27309C10.9536 8.3225 10.9375 8.37943 10.9375 8.4375V10.625H11.5625V8.63063L12.6397 8.09375C12.6919 8.06767 12.7357 8.02751 12.7663 7.9778C12.7968 7.9281 12.8128 7.87084 12.8125 7.8125V5.625H12.1875V7.61937Z" fill="white"/>
              <path d="M16.875 8.24437L13.9228 9.72031C13.8709 9.74627 13.8272 9.78619 13.7967 9.83559C13.7661 9.885 13.75 9.94193 13.75 10V11.5625H14.375V10.1931L17.3272 8.71875C17.3794 8.69267 17.4232 8.65251 17.4538 8.6028C17.4843 8.5531 17.5003 8.49584 17.5 8.4375V5.625H16.875V8.24437Z" fill="white"/>
              <path d="M12.1875 4.375H12.8125V5H12.1875V4.375Z" fill="white"/>
              <path d="M2.5 4.375H3.125V5H2.5V4.375Z" fill="white"/>
              <path d="M7.1875 4.375H7.8125V5H7.1875V4.375Z" fill="white"/>
              <path d="M16.875 4.375H17.5V5H16.875V4.375Z" fill="white"/>
              <path d="M14.375 15.88V15.5084C14.375 15.4553 14.3646 15.4028 14.3443 15.3537C14.324 15.3047 14.2943 15.2601 14.2568 15.2225C14.2192 15.185 14.1747 15.1552 14.1256 15.1348C14.0766 15.1145 14.024 15.1041 13.9709 15.1041C13.8838 15.1048 13.7987 15.0777 13.7279 15.0268C13.6572 14.9759 13.6045 14.9038 13.5775 14.8209C13.5104 14.6063 13.424 14.3982 13.3194 14.1991C13.2795 14.1213 13.2655 14.0328 13.2793 13.9466C13.2932 13.8603 13.3343 13.7807 13.3966 13.7194C13.4341 13.6819 13.4639 13.6373 13.4842 13.5883C13.5045 13.5392 13.515 13.4867 13.515 13.4336C13.515 13.3805 13.5045 13.328 13.4842 13.2789C13.4639 13.2299 13.4341 13.1853 13.3966 13.1478L12.7894 12.5406C12.7519 12.5031 12.7073 12.4733 12.6583 12.453C12.6092 12.4327 12.5567 12.4222 12.5036 12.4222C12.4505 12.4222 12.398 12.4327 12.3489 12.453C12.2999 12.4733 12.2553 12.5031 12.2178 12.5406C12.1565 12.6029 12.0769 12.644 11.9906 12.6579C11.9043 12.6717 11.8159 12.6577 11.7381 12.6178C11.539 12.5132 11.3309 12.4268 11.1162 12.3597C11.0334 12.3327 10.9613 12.28 10.9104 12.2092C10.8595 12.1385 10.8324 12.0534 10.8331 11.9663C10.833 11.8591 10.7904 11.7564 10.7147 11.6807C10.6389 11.605 10.5362 11.5625 10.4291 11.5625H9.57094C9.51785 11.5625 9.46527 11.5729 9.41621 11.5932C9.36715 11.6135 9.32257 11.6432 9.28502 11.6807C9.24747 11.7183 9.21768 11.7628 9.19735 11.8119C9.17702 11.8609 9.16656 11.9135 9.16656 11.9666V11.9753C9.16742 12.0599 9.14124 12.1426 9.09183 12.2113C9.04242 12.28 8.97237 12.3311 8.89188 12.3572C8.67425 12.4247 8.46326 12.5121 8.26156 12.6181C8.18381 12.658 8.09535 12.672 8.00907 12.6582C7.92278 12.6443 7.84319 12.6032 7.78188 12.5409C7.74435 12.5034 7.6998 12.4736 7.65076 12.4533C7.60173 12.433 7.54917 12.4225 7.49609 12.4225C7.44302 12.4225 7.39046 12.433 7.34142 12.4533C7.29239 12.4736 7.24784 12.5034 7.21031 12.5409L6.60312 13.1481C6.56558 13.1856 6.53581 13.2302 6.51549 13.2792C6.49517 13.3283 6.48471 13.3808 6.48471 13.4339C6.48471 13.487 6.49517 13.5395 6.51549 13.5886C6.53581 13.6376 6.56558 13.6822 6.60312 13.7197C6.6654 13.781 6.70647 13.8606 6.72035 13.9469C6.73423 14.0332 6.72021 14.1216 6.68031 14.1994C6.57572 14.3985 6.48933 14.6066 6.42219 14.8213C6.39518 14.9041 6.34248 14.9762 6.27174 15.0271C6.20101 15.078 6.1159 15.1051 6.02875 15.1044C5.92164 15.1045 5.81895 15.1471 5.74324 15.2228C5.66753 15.2986 5.625 15.4013 5.625 15.5084V15.88C6.30051 16.0065 6.98217 16.0977 7.66719 16.1531C7.66062 16.0822 7.65625 16.0103 7.65625 15.9375C7.65625 15.3159 7.90318 14.7198 8.34272 14.2802C8.78226 13.8407 9.3784 13.5938 10 13.5938C10.6216 13.5938 11.2177 13.8407 11.6573 14.2802C12.0968 14.7198 12.3438 15.3159 12.3438 15.9375C12.3438 16.0103 12.3394 16.0822 12.3328 16.1531C13.0178 16.0977 13.6995 16.0065 14.375 15.88Z" fill="white"/>
              <path d="M14.0684 13.0625C14.1523 13.28 14.16 13.5195 14.0903 13.7419C15.9613 14.0534 17.1875 14.5706 17.1875 15.1563C17.1875 16.1056 13.9688 16.875 10 16.875C6.03125 16.875 2.8125 16.1056 2.8125 15.1563C2.8125 14.5706 4.03875 14.0534 5.90969 13.7431C5.83999 13.5207 5.8477 13.2812 5.93156 13.0638C3.6875 13.3656 2.1875 13.91 2.1875 14.5313V17.9688C2.1875 18.9181 5.68531 19.6875 10 19.6875C14.3147 19.6875 17.8125 18.9181 17.8125 17.9688V14.5313C17.8125 13.91 16.3125 13.3656 14.0684 13.0625Z" fill="white"/>
            </svg>
            </div>
            <div class="text_16_500 ff_dm_sans ml_12 item_title">Variables</div>
        </div>
      </a> --}}
  </div>
</div>
