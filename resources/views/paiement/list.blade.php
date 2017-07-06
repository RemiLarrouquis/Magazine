<table class="table table-sm">
    <thead class="thead-default">
    <tr>
        <th>#</th>
        <th>Période</th>
        <th>Montant</th>
        <th>Etat</th>
        <th>Transaction</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($paies as $paie)
        <tr>
            <th scope="row">{{$paie->numero}}</th>
            <td>Du : {{$paie->date_debut}} <br> Au : {{$paie->date_fin}}</td>
            <td>{{$paie->montant}}</td>
            <td>{{$paie->etatPaie_libelle}}</td>
            @if($paie->idEtatPaie == 7)
                @if($paie->valider)
                    <td>Validé</td>
                @else
                    <td>En cours...</td>
                @endif
            @else
                <td></td>
            @endif
            <td>
                <a href="#" onclick="showRemb({{$paie->numero}});"
                   class="btn btn-primary btn-sm rounded">
                    Rembourser
                </a>
            </td>
        </tr>
        <tr id="remb{{$paie->numero}}" style="display:none;" class="hideRemb">
            <td colspan="5">
                <label>Montant</label>
                <input type="number" max="{{$paie->montant}}" step="0.01" id="montantRemb">
                <label>ou la totalité</label>
                <input type="checkbox" id="toutRemb">
                <a href="#"
                   class="btn btn-primary btn-sm rounded">
                    Valider
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>