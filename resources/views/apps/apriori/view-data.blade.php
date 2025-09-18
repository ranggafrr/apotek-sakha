@extends('layout.app-index')
@section('content')
    <div class="panel mt-10">
        <div class="flex items center justify-between">
            <h5 class="mb-5 text-lg font-semibold dark:text-white-light md:top-[25px] md:mb-0">{{ $menu }}</h5>
        </div>
        <div class="container mt-4">
            <h2 class="mb-3">Itemset 1</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Support</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemset1 as $row)
                        <tr>
                            <td>{{ implode(', ', $row['itemset']) }}</td>
                            <td>{{ $row['support'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h2 class="mt-5 mb-3">Itemset 2+</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Itemset</th>
                        <th>Support</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemset2 as $row)
                        <tr>
                            <td>{{ implode(', ', $row['itemset']) }}</td>
                            <td>{{ $row['support'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h2 class="mt-5 mb-3">Association Rules</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Rule</th>
                        <th>Support</th>
                        <th>Confidence</th>
                        <th>Lift Ratio</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rules as $rule)
                        <tr>
                            <td>{{ $rule['rule'] }}</td>
                            <td>{{ $rule['support'] }}</td>
                            <td>{{ $rule['confidence'] }}</td>
                            <td>{{ $rule['lift'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada rule ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
