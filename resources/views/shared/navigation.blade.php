<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">LTTng Web View</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a [routerLink]="['/main']"><i class="fa fa-fw fa-dashboard"></i> Main dashboard</a>
            </li>
            <li>
                <a href="/apache"><i class="fa fa-fw fa-bar-chart-o"></i> Apache</a>
            </li>
            <li>
                <a href="/mysql"><i class="fa fa-fw fa-table"></i> MySQL</a>
            </li>
            <li>
                <a href="/php"><i class="fa fa-fw fa-file-code-o "></i> PHP</a>
            </li>
            <li>
                <a href="/cpu-usage"><i class="fa fa-fw fa-desktop"></i> CPU Usage</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> I/O Dashboard<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="/io-usage"><i class="fa fa-fw fa-file"></i> I/O Usage</a>
                    </li>
                    <li>
                        <a href="/io-latency"><i class="fa fa-fw fa-line-chart"></i> I/O Latency</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/lttng-io-latency"><i class="fa fa-fw fa-line-chart"></i> LTTng I/O Latency</a>
            </li>
        </ul>
    </div>
</nav>