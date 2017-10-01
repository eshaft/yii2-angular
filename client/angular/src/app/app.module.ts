import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import { HttpClientModule } from "@angular/common/http";
import {RouterModule, Routes} from "@angular/router";
import { HomeComponent } from './home/home.component';
import { NotFoundComponent } from './not-found/not-found.component';
import { LoginComponent } from './login/login.component';
import { UserComponent } from './user/user.component';
import {UserService} from "./user/user.service";
import { WsComponent } from './ws/ws.component';
import {WsService} from "./ws/ws.service";
import {FormsModule} from "@angular/forms";
import {LoginService} from "./login/login.service";


const routes: Routes = [
    { path: '', component: HomeComponent, pathMatch:'full' },
    { path: 'login', component: LoginComponent },
    { path: 'user/:id', component: UserComponent },
    { path: 'ws', component: WsComponent },


    { path: '**', component: NotFoundComponent },
];


@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    NotFoundComponent,
    LoginComponent,
    UserComponent,
    WsComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    RouterModule.forRoot(routes)
  ],
  providers: [UserService, WsService, LoginService],
  bootstrap: [AppComponent]
})
export class AppModule { }
