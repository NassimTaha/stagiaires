<x-masterAdmin title="Statistiques">
    
    <div class="row">
        <p class="h1 text-center">
            Statistiques <span style="color: rgb(255, 123, 0);">Quota</span>
        </p>
     
            <form action="{{ route('statistique.search') }}" method="POST">
                @csrf
                <div class="d-flex float-end">
                    <div>
                <select style="width: 350px" name="structuresAffectation_id" class="form-select form-select" aria-label=".form-select example">
                    <option value="0">Toutes les structures d'affectations</option>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach($affectations as $affectation)
                        <option value="{{ $affectation->id }}">{{ $counter++ }}. {{ $affectation->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn btn-warning mx-1">
                    <i class="bi bi-search"></i> Rechercher
                </button>
            </div>
                </div>
            </form>
            </div>

            <hr style="border-top: 2px solid black;">
 @if ($operation == 0)     

    
<div class="row" style="margin-bottom: 50px;">
    
        <div class="col-5">
     
         
            <p class="h2">Quota <span style="color: rgb(255, 123, 0);">Projet fin d'étude</span>  </p>
            <br>
            <div class="Technical-bars">
                
                @foreach ($affectations as $key => $affectation)
    <div class="bar">
        
     
            <p class="h4"><span style="color:rgb(6, 186, 3);"> {{ $affectation->name }} <br> </span> Quota: {{ $affectation->quota_pfe }} <br>  Quota disponible: {{ $quota_dispos_pfe[$key] }} <br>    </p>         
      <br>
        <div class="progress-line">
            <span style="width: {{ $pourcentage_dispos_pfe[$key] }}%; position: absolute;"></span>
            <p style="position:absolute;left:{{ $pourcentage_dispos_pfe[$key] }}%;transform:translateX(-50%);margin-top:-40px;">{{ $pourcentage_dispos_pfe[$key] }}%</p>
        </div>
    </div>
            @endforeach
                
            </div>
          
        
        </div>
        <div class="col-2"></div>

        <div class="col-5">
      
          
            <p class="h2">Quota <span style="color:rgb(255, 123, 0);"> Immersion </span> </p>  
            <br>
            <div class="Technical-bars">
                @foreach ($affectations as $key => $affectation)
    <div class="bar">
        
  
            <p class="h4"><span style="color:rgb(6, 186, 3);"> {{ $affectation->name }} <br> </span> Quota:  {{ $affectation->quota_im }} <br>  Quota disponible: {{ $quota_dispos_im[$key] }} <br>  </p>
            
      <br>
        <div class="progress-line">
            <span style="width: {{ $pourcentage_dispos_im[$key] }}%; position: absolute;"></span>
            <p style="position:absolute;left:{{ $pourcentage_dispos_im[$key] }}%;transform:translateX(-50%);margin-top:-40px;">{{ $pourcentage_dispos_im[$key] }}%</p>
        </div>
    </div>
                
            
                @endforeach
            </div>
        
      
        </div>

    
</div>
@endif

@if ($operation == 1) 

<div class="row" style="margin-bottom: 50px;">
    
        <div class="col-5">
      
          
            <p class="h2">Quota <span style="color: rgb(255, 123, 0);">Projet fin d'étude</span></p>
            <br>
            <div class="Technical-bars">             
                @foreach ($affectations as $key => $affectation)
                      @if($affectation->id == $affectationID)
    <div class="bar">
        
    
            <p class="h4" ><span style="color:rgb(6, 186, 3);"> {{ $affectation->name }} <br> </span> Quota: {{ $affectation->quota_pfe }} <br>  Quota disponible: {{ $quota_dispos_pfeR }} <br>  </p>
            
        <br>
        <div class="progress-line">
            <span style="width: {{ $pourcentage_dispos_pfeR }}%; position: absolute;"></span>
            <p style="position:absolute;left:{{ $pourcentage_dispos_pfeR }}%;transform:translateX(-50%);margin-top:-40px;">{{ $pourcentage_dispos_pfeR }}%</p>
        </div>
    </div>
                
                @endif
                @endforeach
                
            </div>
         
       
        </div>
        <div class="col-2"></div>

        <div class="col-5">
         
            <p class="h2">Quota <span style="color:rgb(255, 123, 0);"> Immersion </span> </p>  
            <br>
            <div class="Technical-bars">
                @foreach ($affectations as $key => $affectation)
                    @if($affectation->id == $affectationID)
    <div class="bar">
        
       
            <p class="h4"><span style="color:rgb(6, 186, 3);"> {{ $affectation->name }} <br> </span> Quota:  {{ $affectation->quota_im }} <br>  Quota disponible: {{ $quota_dispos_imR }} <br>  </p>
            
       <br>
        <div class="progress-line">
            <span style="width: {{ $pourcentage_dispos_imR }}%; position: absolute;"></span>
            <p style="position:absolute;left:{{ $pourcentage_dispos_imR }}%;transform:translateX(-50%);margin-top:-40px;">{{ $pourcentage_dispos_imR }}%</p>
        </div>
    </div>
                
               
                @endif
                @endforeach
            </div>
           
        </div>

   
</div>

@endif

    <style>
.bar{
    font-size :23px;
    position: relative;

}
.Technical-bars .bar{
    margin:40px 0;
}

.Technical-bars .bar:first-child{
    margin-top: 0;
}
.Technical-bars .bar:last-child{
    margin-bottom: 0;
}

.Technical-bars .bar .info{
    margin-bottom: 5px;
}


.Technical-bars .bar .info span{
    font-size: 17px;
    font-weight: 500;
    animation:showText 0.5s 1s linear forwards;
    opacity:0;
}

.Technical-bars .bar .progress-line{
    position: relative;
    border-radius: 10px;
    width: 100%;
    height: 10px;
    background-color: black;
    animation: animate 1s cubic-bezier(1,0,0.5,1) forwards;
    transform: scaleX(0);
    transform-origin: left;
}

@keyframes animate{
    100%{
        transform: scaleX(1);
    }
}

.Technical-bars .bar .progress-line span{
    height: 100%;
    background-color: rgb(255, 123, 0);
    position: absolute;
    border-radius: 10px;
    animation: animate 1s 1s cubic-bezier(1,0,0.5,1) forwards;
    transform: scaleX(0);
    transform-origin: left;
}



.progess-line span::after{
    position: absolute;
    padding: 1px 8px;
    background-color: #000;
    color: #fff;
    font-size: 12px;
    border-radius: 3px;
    top: -28px;
    right:0 ;
    animation :showText 0.5s 1.5s linear forwards;
    opacity: 0;
}




.progress-line span::before{
    content:"";
    position: absolute;
    width: 0;
    height: 0;
    border: 7px solid transparent;
    border-bottom-width: 0px;
    border-right-width: 0px;
    border-top-color: #000;
    top:-10px;
    right:0;
    animation: showText 0.5s 1.5s linear forwards;
    opacity: 0;


}
@keyframes showText{
    100%{
        opacity: 1;
    }
}




    </style>

</x-masterAdmin>