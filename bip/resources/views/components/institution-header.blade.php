<div class="header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-3">
                <img id="ins-logo" src="{{ asset('storage/images/' . ($institutionLogo ?? 'default-logo.png')) }}" alt="Logo instytucji" class="img-fluid">
            </div>
            <div class="col-6 text-left">
                <h1 id="tytul_strony">Biuletyn Informacji Publicznej</h1>
                <h2 id="nazwa_instytucji">{{ $institutionName ?? 'Nazwa instytucji' }}</h2>
            </div>
            <div class="col-3 text-end">
                <img id="bip-logo" src="/images/logo-bip.png" alt="Logo BIP" class="img-fluid">
            </div>
        </div>
    </div>
</div>