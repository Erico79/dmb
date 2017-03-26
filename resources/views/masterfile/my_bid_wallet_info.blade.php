<table class="live_table table table-bordered">
    <thead>
    <tr>
        <th>Date</th>
        <th>Description</th>
        <th>Token Amount</th>
        <th>Running Balance</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Running Bal</th>
    </tr>
    </thead>
    <tbody>
    @if(count($tokens))
        <?php
            $total_token_dr = 0;
            $total_token_cr = 0;
            $current_bal = 0;
        ?>
        @foreach($tokens as $token)
            <?php
                $current_bal = $total_token_cr - $total_token_dr;
            ?>
            <tr>
                <td>{{ $token->created_date }}</td>
                <td>{{ $token->description }}</td>
                <td>{{ $token->token_amount }}</td>
                <td>{{ $token->running_balance }}</td>
                <td style="text-align:right;">
                    @if($token->dr_cr == 'DR')
                        <?php $total_token_dr = $total_token_dr + $token->token_amount ?>
                        {{ number_format($token->token_amount, 2) }}
                    @endif
                </td>
                <td style="text-align:right;">
                    @if($token->dr_cr == 'CR')
                        <?php $total_token_cr = $total_token_cr + $token->token_amount ?>
                        {{ number_format($token->token_amount, 2) }}
                    @endif
                </td>
                <td style="text-align:right;">
                    {{ number_format($token->running_balance, 2) }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" style="text-align:right;font-weight:bold">Totals:</td>
            <td style="text-align:right;font-weight:bold">
                {{ number_format($total_token_dr, 2) }}
            </td>
            <td style="text-align:right;font-weight:bold">
                {{ number_format($total_token_cr, 2) }}
            </td>
            <td style="text-align:right;font-weight:bold">
                {{ number_format($current_bal, 2) }}
            </td>
        </tr>
        <tr>
            <td colspan="4" style="text-align:right;font-weight:bold">Current Balance:</td>
            <td colspan="4" style="text-align:right;font-weight:bold">
                {{ number_format($current_bal, 2) }}
            </td>
        </tr>
    @endif
    </tbody>
</table>
