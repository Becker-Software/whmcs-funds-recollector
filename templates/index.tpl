<div>
    <p>Bitte geben Sie das Datum ein um alle Konten anzuzeigen die keine Guthaben aktivität NACH diesem Datum ausweisen.</p>
    <form method="post">
        <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
            <tbody>
            <tr>
                <td width="15%" class="fieldlabel">
                    Datum
                </td>
                <td class="fieldarea">
                    <div class="form-group date-picker-prepend-icon">
                        <input id="inputInvoiceDate" type="text" name="date" value="{$date}"
                               class="form-control date-picker" data-opens="left">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="btn-container">
            <input type="submit" value="Suchen" class="btn btn-default">
        </div>
    </form>
</div>
{if (!empty($clients))}
<div class="tablebg">
    <table id="sortabletbl0" class="datatable" width="100%" border="0" cellspacing="1" cellpadding="3">
        <tbody>
        <tr>
            <th>#</th>
            <th>Kunde</th>
            <th>Guthaben</th>
            <th>Letzte Guthabenbewegung</th>
        </tr>
        {foreach from=$clients item=$client}
            <tr class="text-center">
                <td><a href="clients.php?action=edit&amp;id={$client->id}">{$client->clientnum} (#{$client->id})</a></td>
                <td><a href="clientssummary.php?userid={$client->id}">{$client->firstname} {$client->lastname}</a></td>
                <td>{$client->credit|number_format:2:",":"."}</td>
                <td>{$client->date|date_format:"d.m.Y"}</td>
            </tr>
        {/foreach}
        </tbody>
    </table>
    <form method="post">
        <input type="hidden" name="date" value="{$date}">
        <input type="submit" name="recollect_funds" onclick="return confirm('Bist du dir sicher?')" value="Guthaben einziehen" class="btn btn-danger">
    </form>
</div>
{/if}