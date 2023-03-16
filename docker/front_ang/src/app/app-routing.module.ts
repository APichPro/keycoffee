import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AppComponent } from './app.component';
import { ListeuserComponent } from './listeuser/listeuser.component';
import { HomeComponent } from './home/home.component';
import { FormSearchComponent } from './form-search/form-search.component'
import { RecupdataComponent } from './recupdata/recupdata.component';
import { DetailcleComponent } from './detailcle/detailcle.component';
import { DetailuserComponent } from './detailuser/detailuser.component';
import { DetailcleusersComponent } from './detailcleusers/detailcleusers.component';

const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'listeuser', component: ListeuserComponent },
  { path: 'recupdata', component: RecupdataComponent },
  { path: 'detailcle/:id', component: DetailcleComponent },
  { path: 'detailuser/:id', component: DetailuserComponent },
  { path: 'form-search', component: FormSearchComponent },
  { path: 'detailcleusers/:id', component: DetailcleusersComponent }
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
