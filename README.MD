# Why Ansible

http://probably.co.uk/puppet-vs-chef-vs-ansible.html

# Troubleshooting

## Error Mounting shared folder

Failed to mount folders in Linux guest. This is usually because
the "vboxsf" file system is not available. Please verify that
the guest additions are properly installed in the guest and
can work properly. The command attempted was:

> mount -t vboxsf -o uid=`id -u vagrant`,gid=`getent group vagrant | cut -d: -f3` vagrant /vagrant
> mount -t vboxsf -o uid=`id -u vagrant`,gid=`id -g vagrant` vagrant /vagrant

Solution:

> sudo ln -s /opt/VBoxGuestAdditions-4.3.10/lib/VBoxGuestAdditions /usr/lib/VBoxGuestAdditions

http://stackoverflow.com/questions/22717428/vagrant-error-failed-to-mount-folders-in-linux-guest
