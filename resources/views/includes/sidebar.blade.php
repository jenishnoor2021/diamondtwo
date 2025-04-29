<div class="brand-logo">
  <a href="/admin/dashboard">
    <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
    <h5 class="logo-text">DHD Software</h5>
  </a>
</div>
<ul class="sidebar-menu do-nicescrol">
  <li class="sidebar-header">MAIN NAVIGATION</li>
  <li class="{{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}">
    <a href="/admin/dashboard">
      <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>

  <!-- <li class="{{ (request()->segment(2) == 'slider') ? 'active' : '' }}">
    <a href="/admin/slider">
      <i class="zmdi zmdi-format-list-bulleted"></i> <span>Slider</span>
    </a>
  </li> -->

  <li class="{{ (request()->segment(2) == 'hrdimond') ? 'active' : '' }}">
    <a href="/admin/hrdimond">
      <i class="zmdi zmdi-format-list-bulleted"></i> <span>DI dimond</span>
    </a>
  </li>

  <li class="{{ (request()->segment(2) == 'party') ? 'active' : '' }}">
    <a href="/admin/party">
      <i class="zmdi zmdi-format-list-bulleted"></i> <span>Party</span>
    </a>
  </li>

  <li class="{{ (request()->segment(2) == 'worker') ? 'active' : '' }}">
    <a href="/admin/worker">
      <i class="zmdi zmdi-format-list-bulleted"></i> <span>Worker</span>
    </a>
  </li>

  <li class="{{ (request()->segment(2) == 'dimond') ? 'active' : '' }}">
    <a href="/admin/dimond">
      <i class="zmdi zmdi-format-list-bulleted"></i> <span>Dimond</span>
    </a>
  </li>

  <li class="{{ (request()->segment(2) == 'expense') ? 'active' : '' }}">
    <a href="/admin/expense">
      <i class="zmdi zmdi-format-list-bulleted"></i> <span>Expense</span>
    </a>
  </li>

  <li class="{{ (request()->segment(2) == 'diamondprintlist') ? 'active' : '' }}">
    <a href="/admin/diamondprintlist">
      <i class="zmdi zmdi-format-list-bulleted"></i> <span>Download Barcode</span>
    </a>
  </li>

  <li class="has-submenu {{ (request()->segment(2) == 'report') || (request()->segment(2) == 'worker_report') ? 'active' : '' }}">
    <a href="#">
      <i class="icon-settings mr-2"></i> <span>Reports</span>
    </a>
    <ul class="submenu">
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'report') ? 'active' : '' }}">
        <a href="/admin/report">
          <span>Expence Report</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'worker_report') ? 'active' : '' }}">
        <a href="/admin/worker_report">
          <span>Worker Report</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'worker_issue_report') ? 'active' : '' }}">
        <a href="/admin/worker_issue_report">
          <span>Worker Issue Report</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'party-report') ? 'active' : '' }}">
        <a href="/admin/party-report">
          <span>Party Bill</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'party-filter') ? 'active' : '' }}">
        <a href="/admin/party-filter">
          <span>Party Filter</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'summary') ? 'active' : '' }}">
        <a href="/admin/summary">
          <span>Summary</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'worker_summary') ? 'active' : '' }}">
        <a href="/admin/worker_summary">
          <span>Worker Summary</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'dimond_list') ? 'active' : '' }}">
        <a href="/admin/dimond_list">
          <span>ADD Dimond list</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="has-submenu {{ (request()->segment(2) == 'worker_slip') || (request()->segment(2) == 'dimond_slip') ? 'active' : '' }}">
    <a href="#">
      <i class="icon-settings mr-2"></i> <span>Slips</span>
    </a>
    <ul class="submenu">
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'worker_slip') ? 'active' : '' }}">
        <a href="/admin/worker_slip">
          <span>Worker slip</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'dimond_slip') ? 'active' : '' }}">
        <a href="/admin/dimond_slip">
          <span>Dimonds slip</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="{{ (request()->segment(2) == 'daily-status') ? 'active' : '' }}">
    <a href="/admin/daily-status">
      <i class="zmdi zmdi-format-list-bulleted"></i> <span>Direct Issues/Return</span>
    </a>
  </li>

  <li class="{{ (request()->segment(2) == 'invoice') ? 'active' : '' }}">
    <a href="/admin/invoice">
      <i class="zmdi zmdi-format-list-bulleted"></i> <span>Invoices</span>
    </a>
  </li>

  <li class="{{ (request()->segment(2) == 'worker-barcode') ? 'active' : '' }}">
    <a href="/admin/worker-barcode">
      <i class="zmdi zmdi-format-list-bulleted"></i> <span>Generate worker barcode</span>
    </a>
  </li>

  <li class="has-submenu {{ (request()->segment(2) == 'check-in') || (request()->segment(2) == 'check-out') || (request()->segment(2) == 'attendance') ? 'active' : '' }}">
    <a href="#">
      <i class="icon-settings mr-2"></i> <span>Attendance</span>
    </a>
    <ul class="submenu">
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'check-in') ? 'active' : '' }}">
        <a href="/admin/check-in">
          <span>Check in</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'check-out') ? 'active' : '' }}">
        <a href="/admin/check-out">
          <span>Check Out</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'attendance') ? 'active' : '' }}">
        <a href="/admin/attendance">
          <span>Attendance List</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'attendance-summary') ? 'active' : '' }}">
        <a href="/admin/attendance-summary">
          <span>Attendance Summary</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="has-submenu {{ (request()->segment(2) == 'worker_rate') || (request()->segment(2) == 'party_rate') || (request()->segment(2) == 'designation') ? 'active' : '' }}">
    <a href="#">
      <i class="icon-settings mr-2"></i> <span>Setting</span>
    </a>
    <ul class="submenu">
      <!-- <li class="pt-2 pb-2 {{ (request()->segment(2) == 'party_rate') ? 'active' : '' }}">
        <a href="/admin/party_rate">
          <span>Party Rate</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'worker_rate') ? 'active' : '' }}">
        <a href="/admin/worker_rate">
          <span>Worker Rate</span>
        </a>
      </li> -->
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'designation') ? 'active' : '' }}">
        <a href="/admin/designation">
          <span>Designation</span>
        </a>
      </li>
      <li class="pt-2 pb-2 {{ (request()->segment(2) == 'company') ? 'active' : '' }}">
        <a href="/admin/company">
          <span>Company Detail</span>
        </a>
      </li>
    </ul>
  </li>

</ul>