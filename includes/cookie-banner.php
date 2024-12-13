<div id="cookie-banner">
  <p> By clicking “Accept All Cookies”, you agree to the storing of cookies on your device to enhance site
    navigation, analyze site usage, and assist in our marketing efforts.</p>
  <div class="cookie-btn d-flex">
    <button class="accept" onclick="acceptCookies()">Accept</button>
    <button class="reject" onclick="rejectCookies()">Reject</button>
  </div>
</div>

<style>
  #cookie-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #3097cc;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.12), 0 2px 2px rgba(0, 0, 0, 0.12), 0 4px 4px rgba(0, 0, 0, 0.12), 0 8px 8px rgba(0, 0, 0, 0.12), 0 16px 16px rgba(0, 0, 0, 0.12);
    color: #fff;
    padding: 15px 15px 10px 15px;
    align-items: center;
    z-index: 1000;
    display: none;
  }

  #cookie-banner button {
    margin-left: 10px;
    padding: 10px 46px;
    border: none;
    cursor: pointer;
  }

  .accept {
    background-color: #28a745;
    color: #fff;
  }

  .reject {
    background-color: #dc3545;
    color: #fff;
  }

  #cookie-banner p {
    font-size: 13px;
    color: #fff;
  }

  .cookie-btn {
    margin-right: 40px;
  }

  @media (max-width: 768px) {
    #cookie-banner {
      flex-direction: column;
      text-align: center;
      padding: 20px;
    }

    #cookie-banner p {
      font-size: 15px;
      margin-bottom: 15px;
    }

    .cookie-btn {
      flex-direction: column;
      gap: 10px;
      width: 100%;
    }

    .cookie-btn button {
      width: 100%;
    }
  }

  @media (max-width: 480px) {
    #cookie-banner {
      padding: 15px;
    }

    #cookie-banner p {
      font-size: 14px;
    }

    .cookie-btn button {
      padding: 8px 10px;
      font-size: 14px;
    }
  }
</style>

<script>
  function setCustomCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    const expires = `expires=${date.toUTCString()}`;
    document.cookie = `${name}=${value}; ${expires}; path=/; SameSite=Lax`;
  }

  function getCookie(name) {
    const cookies = document.cookie.split('; ');
    for (let cookie of cookies) {
      const [key, value] = cookie.split('=');
      if (key === name) return value;
    }
    return null;
  }

  function acceptCookies() {
    setCustomCookie('cookieConsent', 'accepted', 30);
    hideCookieBanner();
  }

  function rejectCookies() {
    setCustomCookie('cookieConsent', 'rejected', 30);
    hideCookieBanner();
  }

  function hideCookieBanner() {
    const banner = document.getElementById('cookie-banner');
    if (banner) {
      banner.style.display = 'none';
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const consent = getCookie('cookieConsent');
    if (!consent) {
      const banner = document.getElementById('cookie-banner');
      if (banner) {
        banner.style.display = 'flex';
      }
    }
  });
</script>
