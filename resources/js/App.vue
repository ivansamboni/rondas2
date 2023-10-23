<template>
   
  <nav class="navbar navbar-expand-md navbar-light bg-light border-bottom sticky-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link to="/estrategias" class="nav-link"><i class="bi bi-journal-text" ></i> Estrategias</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/servicios" class="nav-link"><i class="bi bi-building"></i> Servicios</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/cargos" class="nav-link"><i class="bi bi-person-vcard"></i> Cargos</router-link>
          </li>

        </ul>
      </div>
    </div>
  </nav>
 

<router-view/>
</template>
