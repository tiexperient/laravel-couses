<style>
/* RODAPÉ */
.footer {
    margin-left: 250px; /* acompanha a sidebar */
    padding: 18px 20px;
    background: #f9f9f9;
    color: #828282;
    text-align: center;
    font-size: 14px;
    border-top: 1px solid #aeaeae;
    position: fixed;
    bottom: 0;
    width: calc(100% - 250px);
}
</style>
    <footer class="footer">
        @yield('footer')
        <p>© {{ date('Y') }} Celke — Painel Administrativo</p>
    </footer>