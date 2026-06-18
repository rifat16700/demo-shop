<div class="code-section">
  <div class="lang-nav">
    <button class="lang-btn active" onclick="switchTab(this, 'vp-php')">PHP</button>
    <button class="lang-btn" onclick="switchTab(this, 'vp-guzzle')">PHP Guzzle</button>
    <button class="lang-btn" onclick="switchTab(this, 'vp-node')">Javascript Node</button>
    <button class="lang-btn" onclick="switchTab(this, 'vp-python')">Python</button>
    <button class="lang-btn" onclick="switchTab(this, 'vp-native')">Go (Native)</button>
  </div>
  <div class="code-display">
    <button class="copy-btn" onclick="copyCode(this)">Copy Code</button>
    
    <!-- PHP -->
    <div class="code-panel active" id="vp-php">
      <div class="code-box">
<pre><code>&lt;?php&#10;$curl = curl_init();&#10;curl_setopt_array($curl, [&#10;    CURLOPT_URL => '<?= GLOBAL_PAYMENT_URL ?>api/payment/verify',&#10;    CURLOPT_RETURNTRANSFER => true,&#10;    CURLOPT_CUSTOMREQUEST => 'POST',&#10;    CURLOPT_POSTFIELDS => '{"transaction_id":"T123"}',&#10;    CURLOPT_HTTPHEADER => [&#10;        'API-KEY: YOUR_KEY',&#10;        'Content-Type: application/json'&#10;    ],&#10;]);&#10;$res = curl_exec($curl);&#10;curl_close($curl);&#10;echo $res;&#10;?&gt;</code></pre>
      </div>
    </div>

    <!-- PHP Guzzle -->
    <div class="code-panel" id="vp-guzzle">
      <div class="code-box">
<pre><code>&lt;?php&#10;$client = new \GuzzleHttp\Client();&#10;$res = $client->post('<?= GLOBAL_PAYMENT_URL ?>api/payment/verify', [&#10;    'headers' => [&#10;        'API-KEY'      => 'YOUR_KEY',&#10;        'Content-Type' => 'application/json',&#10;    ],&#10;    'json' => [&#10;        'transaction_id' => 'T123'&#10;    ]&#10;]);&#10;echo $res->getBody();&#10;?&gt;</code></pre>
      </div>
    </div>

    <!-- Node -->
    <div class="code-panel" id="vp-node">
      <div class="code-box">
<pre><code>const axios = require('axios');&#10;axios.post('<?= GLOBAL_PAYMENT_URL ?>api/payment/verify', {&#10;    transaction_id: 'T123'&#10;}, {&#10;    headers: {&#10;        'API-KEY': 'YOUR_KEY',&#10;        'Content-Type': 'application/json'&#10;    }&#10;}).then(res => console.log(res.data));</code></pre>
      </div>
    </div>

    <!-- Python -->
    <div class="code-panel" id="vp-python">
      <div class="code-box">
<pre><code>import requests&#10;import json&#10;&#10;url = "<?= GLOBAL_PAYMENT_URL ?>api/payment/verify"&#10;payload = json.dumps({"transaction_id": "T123"})&#10;headers = {&#10;    "API-KEY": "YOUR_KEY",&#10;    "Content-Type": "application/json"&#10;}&#10;res = requests.post(url, headers=headers, data=payload)&#10;print(res.text)</code></pre>
      </div>
    </div>

    <!-- Go (Native) -->
    <div class="code-panel" id="vp-native">
      <div class="code-box">
<pre><code>package main&#10;&#10;import (&#10;  "fmt"&#10;  "strings"&#10;  "net/http"&#10;  "io/ioutil"&#10;)&#10;&#10;func main() {&#10;  url := "<?= GLOBAL_PAYMENT_URL ?>api/payment/verify"&#10;  payload := strings.NewReader(`{"transaction_id":"T123"}`)&#10;&#10;  req, _ := http.NewRequest("POST", url, payload)&#10;  req.Header.Add("API-KEY", "YOUR_KEY")&#10;  req.Header.Add("Content-Type", "application/json")&#10;&#10;  res, _ := http.DefaultClient.Do(req)&#10;  defer res.Body.Close()&#10;&#10;  body, _ := ioutil.ReadAll(res.Body)&#10;  fmt.Println(string(body))&#10;}</code></pre>
      </div>
    </div>
  </div>
</div>
