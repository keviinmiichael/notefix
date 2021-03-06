@extends('layouts.app')

@section('titulo')
  Productos
@endsection

@section('contenido')
  <!-- Page Content -->
  <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Productos
              </h1>
              <ol class="breadcrumb">
                  <li><a href="/">Home</a>
                  </li>
                  <li class="active">Productos</li>
              </ol>
          </div>
      </div>
      <!-- /.row -->




      <!-- Projects Row -->
      <div class="row">
      @foreach($products as $product)
        <div class="col-md-4 img-portfolio" style="height:340px;">
            <a href="products/{{$product->slug}}">
              @forelse($product->images as $image)
                @if ($loop->first)
                  <img class="img-responsive img-hover img-thumbnail" src="/img/{{$image->src}}"style="height:214px; display:block; margin: 0 auto;">
                @endif
              @empty
                <img class="img-responsive img-hover img-thumbnail" src="/img/nhic.png" style="height:214px; display:block; margin: 0 auto;">
              @endforelse
            </a>
            <h3>
                <a href="/products/{{$product->slug}}">{{ str_limit($product->name, $limit=19, $end = '...') }}</a>
            </h3>
            <p>{{ str_limit($product->description, $limit=150, $end = '...')}}</p>
            <h4 style="text-align: right; margin-right: 22px;">
              ${{$product->price}}
            </h4>
        </div>
      @endforeach
    </div>
      <!-- /.row -->

      <hr>

      <!-- Pagination -->
      <div class="row text-center">
          <div class="col-lg-12">
              <ul class="pagination">
                  <li>
                      <a href="#">&laquo;</a>
                  </li>
                  <li class="active">
                      <a href="#">1</a>
                  </li>
                  <li>
                      <a href="#">2</a>
                  </li>
                  <li>
                      <a href="#">3</a>
                  </li>
                  <li>
                      <a href="#">4</a>
                  </li>
                  <li>
                      <a href="#">5</a>
                  </li>
                  <li>
                      <a href="#">&raquo;</a>
                  </li>
              </ul>
          </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Footer -->
      <footer>
          <div class="row">
              <div class="col-lg-12">
                  <p>Copyright &copy; NoteFix 2016</p>
              </div>
          </div>
      </footer>

  </div>
  <!-- /.container -->

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  {{-- <script src="js/bootstrap.min.js"></script> --}}

</body>

</html>
@endsection
