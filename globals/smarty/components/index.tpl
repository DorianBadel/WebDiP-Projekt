    <h2>Statistika problema</h2>

    <label for="kategorija">Kategorija: </label>
    <input type="text" id="kategorija" name="kategorija">
    <label for="minProblema">Problema više od: </label>
    <input type="number" id="minProblema" name="minProblema">

    <table id="problemi">
            <thead>
                <tr>
                    <th>Kategorija</th>
                    <th>Broj problema</th>
                </tr>
            </thead>
    </table>
    <button id="generirajPDF">Generiraj PDF</button>
    <button id="isprintaj">Isprintaj</button>
    <div class="grafContainer">
        <canvas id="grafStatistike"></canvas>
    </div>
</table>
<div class="pomoc" id="pomoc">
    <div id="pomocSadrzaj">Ovo je sadrzaj pomoći...</div>
    <button id="prethodnaStranicaPomoc">Prethodna stranica</button>
    <button id="sljedecaStranicaPomoc">Sljedeća stranica</button>
    <button id="ugasiPomoc">Ugasi pomoć</button>
</div>
