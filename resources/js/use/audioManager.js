import {getTalk, localHost, talk} from './';

export const playAudio = (audioPath) => {
    let audio = new Audio(audioPath);
    audio.play().then(r => {
    }).catch(e => {
        console.log(
            'Error al reproducir el audio, asegurate de que la ruta ' +
            localHost + audioPath +
            ' sea correcta y el archivo exista, Error: ' +
            e
        )
    });

    return audio;
};

export const setOnEnded = (audio, callback) => {
  audio.onended = callback;
};

export function verifyFileExistence(url, callback) {
  let xhr = new XMLHttpRequest();
  xhr.open('HEAD', url, true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      // 200 OK indica que el archivo existe
      if (xhr.status === 200) {
        callback(true);
      } else {
        callback(false);
      }
    }
  };

  xhr.send();
}

export const resolveAudio = (text, name, path, speed) => {
  console.log('Generando audio...')
  axios.post(`${localHost}/loadAudio`, {
    text: text,
    name: name,
    path: path,
    speed: speed,
  }).then(response => {
    console.log(response.data)
  })
}

export const playSuccessShortRandom = () => {
  if (getTalk()) {
    return;
  }

  let chance = Math.random();
  if (chance < 0.8) {
    let random = Math.floor(Math.random() * 10) + 1;
    talk(true);
    let successAudio = playAudio(`${localHost}/audios/successes/shorts/${random}.m4a`, true);

    setOnEnded(successAudio, () => {
      talk(false);
    });
  }
}
