<div>
    <p>Bitte geben Sie das Datum ein um alle Konten anzuzeigen die keine Guthaben aktivität NACH diesem Datum ausweisen.</p>
    <form method="post">
        <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
            <tbody>
            <tr>
                <td width="15%" class="fieldlabel">
                    Kundennummer
                </td>
                <td class="fieldarea">
                    <div class="form-group">
                        <input id="client_id" type="text" name="client_id" class="form-control" value="{$client_id}">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="btn-container">
            <input type="submit" value="Guthaben einziehen" class="btn btn-default">
        </div>
    </form>
</div>