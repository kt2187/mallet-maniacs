async function getData(url) {
  let data = await fetch(url);
  let json = await data.json();
  //  console.log('data: ', json);
  return json;
}

function createElementRepoList(repoData) {
  const ulList = document.createElement('ul');
  ulList.className = 'profile-github';
  if (Array.isArray(repoData)) {
    repoData.forEach((repoItem) => {
      //  console.log('repo: ', repoItem.name);
      const listItem = document.createElement('li');
      const listitemTextNode = document.createTextNode(repoItem.name);

      listItem.appendChild(listitemTextNode);
      ulList.appendChild(listItem);
    });
    document.querySelector('#github-profile-info').appendChild(ulList);
  } else {
    return;
  }
}

function createProfilePicture(profileData) {
  if (profileData.avatar_url && profileData.name) {
    const heading = document.createElement('h2');
    heading.id = 'gh-profile-heading';
    const headingTextNode = document.createTextNode(
      `Github Profile: ${profileData.name}`
    );
    heading.appendChild(headingTextNode);
    document.querySelector('#gh-profile-heading').appendChild(heading);

    let image = document.createElement('img');
    image.src = profileData.avatar_url;
    image.className = 'gh-image';
    document.querySelector('#github-profile-img').appendChild(image);
  } else {
    return;
  }
}

getData('https:api.github.com/users/kt2187/repos').then((data) => {
  createElementRepoList(data);
});

getData('https:api.github.com/users/kt2187').then((data) => {
  console.log('data: ', data);
  createProfilePicture(data);
});
