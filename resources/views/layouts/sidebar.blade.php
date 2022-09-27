<div class="list-group">
    <!--検索機能-->
    <div class="search">
        <form method="GET" action="/search">
            <input type="search" placeholder="キーワードを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
            <div>
                <button type="submit", data-action="/search">検索</button>
            </div>
        </form>
        <button><a href="/">クリア</a></button>
        <p></p>
    </div>
    
</div>