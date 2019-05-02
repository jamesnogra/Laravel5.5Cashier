@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if (!Auth::user()->subscribed('dog-treats'))
                        <form action="/pay/dog-treats/dog_treats_monthly" method="POST" >
                            {{ csrf_field() }}
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ env('STRIPE_KEY') }}"
                                data-amount="099"
                                data-name="Dog Treats"
                                data-description="Monthly Subscription"
                                data-label="Subscribe Monthly $0.99"
                                data-image="https://www.shareicon.net/data/2016/08/18/815505_pet_512x512.png"
                                data-locale="auto">
                            </script>
                        </form>
                        <form action="/pay/dog-treats/dog_treats_6" method="POST" >
                            {{ csrf_field() }}
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ env('STRIPE_KEY') }}"
                                data-amount="549"
                                data-name="Dog Treats"
                                data-description="Every 6 Months Subscription"
                                data-label="Subscribe Every 6 Months $5.49"
                                data-image="https://www.shareicon.net/data/2016/08/18/815505_pet_512x512.png"
                                data-locale="auto">
                            </script>
                        </form>
                        <form action="/pay/dog-treats/dog_treats_yearly" method="POST" >
                            {{ csrf_field() }}
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ env('STRIPE_KEY') }}"
                                data-amount="999"
                                data-name="Dog Treats"
                                data-description="Yearly Subscription"
                                data-label="Yearly $9.99"
                                data-image="https://www.shareicon.net/data/2016/08/18/815505_pet_512x512.png"
                                data-locale="auto">
                            </script>
                        </form>
                    @else
                        @if ($user->subscription('dog-treats')->onGracePeriod())
                            <div class="alert alert-danger">
                                <p>You have cancelled but still on prepaid time on your subscription.</p>
                                <a href="/cancel/dog-treats/immediate" class="btn btn-small btn-danger">Cancel Subscription Immediately</a>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <p>You are subscribed to a plan...</p>
                                <a href="/cancel/dog-treats/ordinary" class="btn btn-small btn-danger">Cancel Subscription</a>
                            </div>
                        @endif
                    @endif

                    <h4>Invoices</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Invoice Date</th>
                                <th>Total</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->invoices() as $invoice)
                                {{var_dump($invoice->total())}}
                            @endforeach
                        </tbody>
                    </table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
