import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { Router } from '@angular/router';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ListeuserComponent } from './listeuser/listeuser.component';
import { HomeComponent } from './home/home.component';
import { RecupdataComponent } from './recupdata/recupdata.component';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule }   from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { DetailcleComponent } from './detailcle/detailcle.component';
import { DetailuserComponent } from './detailuser/detailuser.component';
import { DetailcleusersComponent } from './detailcleusers/detailcleusers.component';
import { DetailuserclesComponent } from './detailusercles/detailusercles.component';
import { FormSearchComponent } from './form-search/form-search.component';

@NgModule({
  declarations: [
    AppComponent,
    ListeuserComponent,
    HomeComponent,
    RecupdataComponent,
    DetailcleComponent,
    DetailuserComponent,
    DetailcleusersComponent,
    DetailuserclesComponent,
    FormSearchComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {
  constructor(router: Router){
      console.log('Route: ', JSON.stringify(router.config, undefined, 2));
   }
 }
