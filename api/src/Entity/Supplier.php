<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * An entity representing a supplier of products
 *
 * This entity represents a supplier that delivers products to the seller. For example: if we are a municipality we sell passports to our inhabitants, but these passports are made by the ministry of internal affairs.
 *
 * @author Robert Zondervan <robert@conduction.nl>
 * @category Entity
 * @license EUPL <https://github.com/ConductionNL/productenendienstencatalogus/blob/master/LICENSE.md>
 * @package PDC
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SupplierRepository")
 */
class Supplier
{
	/**
	 * @var UuidInterface $id The Uuid identifier of this supplier
	 *
	 * @ApiProperty(
	 * 	   identifier=true,
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "The UUID identifier of this object",
	 *             "type"="string",
	 *             "format"="uuid",
	 *             "example"="e2984465-190a-4562-829e-a8cca81aa35d"
	 *         }
	 *     }
	 * )
	 *
     * @Assert\Uuid
	 * @Groups({"read"})
	 * @ORM\Id
	 * @ORM\Column(type="uuid", unique=true)
	 * @ORM\GeneratedValue(strategy="CUSTOM")
	 * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
	 */
	private $id;

	/**
	 * @var string $sourceOrganization The RSIN of the organization that owns this process
	 * @example 002851234
	 *
	 * @ApiProperty(
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "The RSIN of the organization that owns this process",
	 *             "type"="string",
	 *             "example"="002851234",
	 *              "maxLength"="255"
	 *         }
	 *     }
	 * )
	 *
	 * @Assert\NotNull
	 * @Assert\Length(
	 *      min = 8,
	 *      max = 11
	 * )
	 * @Groups({"read", "write"})
	 * @ORM\Column(type="string", length=255)
	 * @ApiFilter(SearchFilter::class, strategy="exact")
	 */
	private $sourceOrganization;

    /**
     * @var string $name The name of this RequestType
     * @example My RequestType
     *
     * @ApiProperty(
     * 	   iri="http://schema.org/name",
     *     attributes={
     *         "swagger_context"={
     *         	   "description" = "The name of this RequestType",
     *             "type"="string",
     *             "example"="My RequestType",
     *             "maxLength"="255",
     *             "required" = true
     *         }
     *     }
     * )
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string $kvk The number under which the supplier is registered at the chamber of commerce
     * @example 30280353
     *
     * @ApiProperty(
     *     attributes={
     *         "swagger_context"={
     *         	   "description" = "The number under which the supplier is registered at the chamber of commerce",
     *             "type"="string",
     *             "example"="30280353",
     *             "maxLength"="255",
     *             "required" = true
     *         }
     *     }
     * )
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $kvk;

    /**
     * @var string $logo The logo for this component
     * @example https://www.my-organization.com/logo.png
     *
     * @ApiProperty(
     * 	   iri="https://schema.org/logo",
     *     attributes={
     *         "swagger_context"={
     *         	   "description" = "The logo for this component",
     *             "type"="string",
     *             "format"="url",
     *             "example"="https://www.my-organization.com/logo.png",
     *             "maxLength"=255
     *         }
     *     }
     * )
     *
     * @Assert\Url
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    public function getId()
    {
        return $this->id;
    }

    public function getSourceOrganization(): ?string
    {
    	return $this->sourceOrganization;
    }

    public function setSourceOrganization(string $sourceOrganization): self
    {
    	$this->sourceOrganization = $sourceOrganization;

    	return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getKvk(): ?string
    {
        return $this->kvk;
    }

    public function setKvk(string $kvk): self
    {
        $this->kvk = $kvk;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
