<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>
        Invoice {{ $invoice->invoice_number }}
    </title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        .total {
            text-align: right;
            margin-top: 30px;
            font-size: 18px;
        }
    </style>

</head>


<body>


    <div class="header">


        <div>

            <h1>
                Invoice
            </h1>

            <p>
                {{ $invoice->invoice_number }}
            </p>

            <p>
                Date:
                {{ $invoice->created_at->format('d M Y') }}
            </p>

        </div>



        <div>

            <h3>
                Customer
            </h3>


            <p>
                {{ $invoice->customer_name ?? $invoice->user?->name }}
            </p>


            @if ($invoice->customer_email)
                <p>
                    {{ $invoice->customer_email }}
                </p>
            @endif


        </div>


    </div>




    @if ($invoice->shop)
        <h3>
            Shop
        </h3>

        <p>
            {{ $invoice->shop->name }}
        </p>
    @endif




    <table>


        <thead>

            <tr>

                <th>
                    Service / Product
                </th>


                <th>
                    Quantity
                </th>


                <th>
                    Price
                </th>


                <th>
                    Total
                </th>

            </tr>

        </thead>


        <tbody>


            @foreach ($invoice->items as $item)
                <tr>


                    <td>
                        {{ $item->title }}
                    </td>


                    <td>
                        {{ $item->quantity }}
                    </td>


                    <td>
                        AED {{ number_format($item->price, 2) }}
                    </td>


                    <td>
                        AED {{ number_format($item->total, 2) }}
                    </td>


                </tr>
            @endforeach


        </tbody>


    </table>




    <div class="total">


        <p>
            Subtotal:
            AED {{ number_format($invoice->subtotal, 2) }}
        </p>


        @if ($invoice->tax)
            <p>
                Tax:
                AED {{ number_format($invoice->tax, 2) }}
            </p>
        @endif


        <strong>

            Total:
            AED {{ number_format($invoice->total, 2) }}

        </strong>


    </div>



</body>

</html>
