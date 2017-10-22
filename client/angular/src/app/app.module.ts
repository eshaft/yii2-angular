import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import { HttpClientModule } from "@angular/common/http";
import {RouterModule, Routes} from "@angular/router";
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { UserComponent } from './user/user.component';
import {UserService} from "./user/user.service";
import { WsComponent } from './ws/ws.component';
import {WsService} from "./ws/ws.service";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {LoginService} from "./login/login.service";
import {NgbModule} from "@ng-bootstrap/ng-bootstrap";
import { LogoutComponent } from './logout/logout.component';
import { RequestPasswordResetComponent } from './request-password-reset/request-password-reset.component';
import { SignupComponent } from './signup/signup.component';
import { BreadcrumbComponent } from './breadcrumb/breadcrumb.component';
import {AlertService} from "./alert.service";
import { ResetPasswordComponent } from './reset-password/reset-password.component';
import { DynamicDirective } from './dynamic.directive';
import { ErrorComponent } from './error/error.component';


const routes: Routes = [
    { path: '', component: HomeComponent, pathMatch:'full' },
    { path: 'signup', component: SignupComponent },
    { path: 'login', component: LoginComponent },
    { path: 'logout', component: LogoutComponent },
    { path: 'request-password-reset', component: RequestPasswordResetComponent },
    {
        path: 'reset-password',
        component: ResetPasswordComponent
    },
    { path: 'user/:id', component: UserComponent },
    { path: 'ws', component: WsComponent },


    { path: '**', component: ErrorComponent },
];


@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    LoginComponent,
    UserComponent,
    WsComponent,
    LogoutComponent,
    RequestPasswordResetComponent,
    SignupComponent,
    BreadcrumbComponent,
    ResetPasswordComponent,
    DynamicDirective,
    ErrorComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    RouterModule.forRoot(routes),
    NgbModule.forRoot()
  ],
  providers: [
      UserService, WsService, LoginService, AlertService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
