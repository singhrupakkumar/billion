<!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <title>{{__('Billionaire - Contact Query To Admin')}}</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  </head>

  <body style="background-color: #dbdbdb; padding: 10px">
    <div
      style="max-width: 600px; background-color: #ffffff; background-image: url('https://travellerbuckets.s3.amazonaws.com/bg.png'); background-position: center; background-repeat: no-repeat; width: 100%; margin: auto; border-radius: 5px;">
      <table style="border-collapse: collapse; width: 100%;">
        <thead>
          <tr>
            <th style="padding: 20px 0 5px 30px; border-bottom: 1px solid #979797; text-align: left"><img src="https://travellerbuckets.s3.amazonaws.com/logo.png"
                alt="Logo" style="max-height: 80px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="padding: 0 30px 20px;">
              <h3 style="font-family: 'Lato', sans-serif; font-weight: 700; color: #000; margin: 20px 0px;">
              {{__('Greetings from Billionaire')}},</h3>

              <p
                style="font-family: 'Lato', sans-serif; font-size: 16px; font-weight: bold; color: #333; line-height: 24px; margin:20px 0px 10px 0px;">
                You have received a new query from a user. 
              </p>

                <p
                style="font-family: 'Lato', sans-serif; font-size: 16px; font-weight: bold; color: #333; line-height: 24px; margin:0px 0px 0px 0px;">
                Name: {{$requestdata['first_name']}} {{$requestdata['last_name']}} </p>


             <p
                style="font-family: 'Lato', sans-serif; font-size: 16px; font-weight: bold; color: #333; line-height: 24px; margin:0px 0px 0px 0px;">
                Email: {{$requestdata['email']}} </p>


              <p
                style="font-family: 'Lato', sans-serif; font-size: 16px; font-weight: bold; color: #333; line-height: 24px; margin:20px 0px 30px 0px;">
                Description: 
                {{$requestdata['message']}} 
                </p>

              <p
                style="font-family: 'Lato', sans-serif; font-size: 16px; color: #131313; line-height: 24px; margin:25px 0px;">
                If you have any query regarding this please feel free to contact us at <a
                  href="mailto:@if(\App\Config::get_field('email')) {{ \App\Config::get_field('email') }} @else {{ env('ADMIN_EMAIL') }} @endif">@if(\App\Config::get_field('email')) {{ \App\Config::get_field('email') }} @else {{ env('ADMIN_EMAIL') }} @endif</a>
              </p>
              <p
                style="font-family: 'Lato', sans-serif; font-size: 16px; color: #131313; line-height: 24px; margin:0px 0px 0px 0px;">
                Thanks,</p>
              <p
                style="font-family: 'Lato', sans-serif; font-size: 16px; color: #131313; line-height: 24px; margin:0px 0px 0px 0px;">
                Billionaire</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>

  </html>