@php
    use App\Enums\Role;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    $user = User::find(Auth::user()->id);
    $roles = $user->roles;
    $isAdmin = false;
    for ($i = 0; $i<count($roles);$i++){
        if($roles[$i]->name == Role::ADMIN){
            $isAdmin = true;
        }
    }
@endphp

@extends('master')

@section('title', 'Home page')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header ">
                        @if($isAdmin)
                            <h4 class="card-title">
                                <a href="{{route('statistic.list.search')}}">Statistics Search Products</a>
                            </h4>
                        @else
                            <h4 class="card-title">Statistics Search Products</h4>
                        @endif
                        <p class="card-category">Last Performance</p>
                    </div>
                    <div class="card-body ">
                        <div id="chartPreferencesSearch" class="ct-chart ct-perfect-fourth"></div>
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Taobao
                            <i class="fa fa-circle text-danger"></i> 1688
                            <i class="fa fa-circle text-warning"></i> Alibaba
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header ">
                        @if($isAdmin)
                            <h4 class="card-title">
                                <a href="{{route('statistic.list.order')}}">Statistics Order Products</a>
                            </h4>
                        @else
                            <h4 class="card-title">Statistics Order Products</h4>
                        @endif
                        <p class="card-category">Last Performance</p>
                    </div>
                    <div class="card-body ">
                        <div id="chartPreferencesOrder" class="ct-chart ct-perfect-fourth"></div>
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Taobao
                            <i class="fa fa-circle text-danger"></i> 1688
                            <i class="fa fa-circle text-warning"></i> Alibaba
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Users Accesss</h4>
                        <p class="card-category">6 Months performance</p>
                    </div>
                    <div class="card-body ">
                        <div id="chartHours" class="ct-chart"></div>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Accesss
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Updated now
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">2017 Sales</h4>
                        <p class="card-category">All products including Taxes</p>
                    </div>
                    <div class="card-body ">
                        <div id="chartActivity" class="ct-chart"></div>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Tesla Model S
                            <i class="fa fa-circle text-danger"></i> BMW 5 Series
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-check"></i> Data information certified
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card  card-tasks">
                    <div class="card-header ">
                        <h4 class="card-title">Tasks</h4>
                        <p class="card-category">Backend development</p>
                    </div>
                    <div class="card-body ">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Sign contract for "What are conference organizers afraid of?"</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task"
                                                class="btn btn-info btn-simple btn-link">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove"
                                                class="btn btn-danger btn-simple btn-link">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked>
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task"
                                                class="btn btn-info btn-simple btn-link">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove"
                                                class="btn btn-danger btn-simple btn-link">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked>
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Flooded: One year later, assessing what was lost and what was found when a
                                        ravaging rain swept through metro Detroit
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task"
                                                class="btn btn-info btn-simple btn-link">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove"
                                                class="btn btn-danger btn-simple btn-link">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" checked>
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task"
                                                class="btn btn-info btn-simple btn-link">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove"
                                                class="btn btn-danger btn-simple btn-link">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Read "Following makes Medium better"</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task"
                                                class="btn btn-info btn-simple btn-link">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove"
                                                class="btn btn-danger btn-simple btn-link">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" disabled>
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>Unfollow 5 enemies from twitter</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task"
                                                class="btn btn-info btn-simple btn-link">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove"
                                                class="btn btn-danger btn-simple btn-link">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
@endsection

